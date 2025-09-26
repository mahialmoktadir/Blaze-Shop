<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Category;
use App\Models\Product;
use App\Models\Productcart;

class CartController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);

        // If user is logged in, merge persisted DB cart items into the session cart
        if (Auth::check()) {
            $userId = Auth::id();
            $persisted = Productcart::where('user_id', $userId)->get();
            foreach ($persisted as $pc) {
                $p = Product::find($pc->product_id);
                if (!$p) continue;
                if (isset($cart[$p->id])) {
                    // prefer the larger quantity
                    $cart[$p->id]['quantity'] = max($cart[$p->id]['quantity'], $pc->quantity);
                } else {
                    $cart[$p->id] = [
                        'id' => $p->id,
                        'name' => $p->name,
                        'price' => $p->price,
                        'quantity' => $pc->quantity,
                        'image' => $p->image,
                    ];
                }
            }
            session()->put('cart', $cart);
        }
        $totalPrice = collect($cart)->sum(fn($item) => $item['price'] * $item['quantity']);
        $totalItems = collect($cart)->sum('quantity');

        return view('cart.index', compact('cart', 'totalPrice', 'totalItems'));
    }

    public function add(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            $cart[$id] = [
                "id" => $product->id,
                "name" => $product->name,
                "price" => $product->price,
                "quantity" => 1,
                "image" => $product->image
            ];
        }

        session()->put('cart', $cart);

        // If user is logged in, persist to productcarts table
        if (Auth::check()) {
            $userId = Auth::id();

            // Find existing productcart for this user and product
            $pc = Productcart::where('user_id', $userId)->where('product_id', $product->id)->first();
            if ($pc) {
                $pc->quantity = $pc->quantity + 1;
                $pc->save();
            } else {
                Productcart::create([
                    'user_id' => $userId,
                    'product_id' => $product->id,
                    'quantity' => 1,
                ]);
            }
        }

        return redirect()->back()->with('success', 'Product added to cart!');
    }

    public function update(Request $request, $id)
    {
        $cart = session()->get('cart', []);
        if (isset($cart[$id])) {
            $quantity = (int) $request->quantity;
            $cart[$id]['quantity'] = $quantity;
            session()->put('cart', $cart);

            // If user is logged in, update persisted quantity
            if (Auth::check()) {
                $userId = Auth::id();
                $pc = Productcart::where('user_id', $userId)->where('product_id', $id)->first();
                if ($pc) {
                    $pc->quantity = $quantity;
                    // if quantity is zero or less, delete the record
                    if ($pc->quantity <= 0) {
                        $pc->delete();
                    } else {
                        $pc->save();
                    }
                }
            }
        }
        return redirect()->back()->with('success', 'Cart updated!');
    }

    public function remove($id)
    {
        $cart = session()->get('cart', []);
        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }

        // Also remove persisted entry for authenticated users
        if (Auth::check()) {
            $userId = Auth::id();
            Productcart::where('user_id', $userId)->where('product_id', $id)->delete();
        }
        return redirect()->back()->with('success', 'Product removed!');
    }
}

