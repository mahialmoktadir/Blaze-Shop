<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Product;
use App\Models\Productcart;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'order_email' => 'required|email',
            'order_phone' => 'required|string',
            'order_address' => 'required|string',
        ]);

        $cart = session()->get('cart', []);
        if (Auth::check()) {
            $userId = Auth::id();
            $persisted = Productcart::where('user_id', $userId)->get();
            foreach ($persisted as $pc) {
                $p = Product::find($pc->product_id);
                if (!$p) continue;
                if (isset($cart[$p->id])) {
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
        }

        if (empty($cart)) {
            return redirect()->back()->with('error', 'Your cart is empty');
        }

        foreach ($cart as $item) {
            Order::create([
                'user_id' => Auth::check() ? Auth::id() : null,
                'receiver_email' => $data['order_email'],
                'receiver_phone' => $data['order_phone'],
                'receiver_address' => $data['order_address'],
                'product_id' => $item['id'],
                'quantity' => $item['quantity'],
            ]);
        }


        session()->forget('cart');


        if (Auth::check()) {
            Productcart::where('user_id', Auth::id())->delete();
        }

        return redirect()->route('cart.index')->with('success', 'Order placed successfully!');
    }


    public function checkout(Request $request)
    {
        $data = $request->validate([
            'order_email' => 'required|email',
            'order_phone' => 'required|string',
            'order_address' => 'required|string',
            'payment_method' => 'required|in:online,cod',
        ]);

        $cart = session()->get('cart', []);
        if (Auth::check()) {
            $userId = Auth::id();
            $persisted = Productcart::where('user_id', $userId)->get();
            foreach ($persisted as $pc) {
                $p = Product::find($pc->product_id);
                if (!$p) continue;
                if (isset($cart[$p->id])) {
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
        }

        if (empty($cart)) {
            return redirect()->back()->with('error', 'Your cart is empty');
        }

        if ($data['payment_method'] === 'cod') {

            foreach ($cart as $item) {
                Order::create([
                    'user_id' => Auth::check() ? Auth::id() : null,
                    'receiver_email' => $data['order_email'],
                    'receiver_phone' => $data['order_phone'],
                    'receiver_address' => $data['order_address'],
                    'product_id' => $item['id'],
                    'quantity' => $item['quantity'],
                ]);
            }


            session()->forget('cart');
            if (Auth::check()) {
                Productcart::where('user_id', Auth::id())->delete();
            }

            return redirect()->route('cart.index')->with('success', 'Order placed successfully (Cash on Delivery).');
        }


        session(['pending_order' => [
            'contact' => [
                'email' => $data['order_email'],
                'phone' => $data['order_phone'],
                'address' => $data['order_address'],
            ],
            'cart' => $cart,
        ]]);

        return redirect()->route('orders.payment');
    }


    public function paymentPage()
    {
        $pending = session('pending_order');
        if (!$pending || empty($pending['cart'])) {
            return redirect()->route('cart.index')->with('error', 'No pending order found.');
        }


        $total = 0;
        foreach ($pending['cart'] as $item) {
            $total += ($item['price'] ?? 0) * ($item['quantity'] ?? 0);
        }

        return view('orders.payment', ['pending' => $pending, 'total' => $total]);
    }


    public function processPayment(Request $request)
    {
        $pending = session('pending_order');
        if (!$pending || empty($pending['cart'])) {
            return redirect()->route('cart.index')->with('error', 'No pending order to pay for.');
        }


        $data = $request->validate([
            'order_email' => 'required|email',
            'order_phone' => 'required|string',
            'order_address' => 'required|string',
        ]);



        $contact = [
            'email' => $data['order_email'] ?? ($pending['contact']['email'] ?? null),
            'phone' => $data['order_phone'] ?? ($pending['contact']['phone'] ?? null),
            'address' => $data['order_address'] ?? ($pending['contact']['address'] ?? null),
        ];

        $cart = $pending['cart'];

        foreach ($cart as $item) {
            Order::create([
                'user_id' => Auth::check() ? Auth::id() : null,
                'receiver_email' => $contact['email'],
                'receiver_phone' => $contact['phone'],
                'receiver_address' => $contact['address'],
                'product_id' => $item['id'],
                'quantity' => $item['quantity'],
            ]);
        }

        session()->forget('pending_order');
        session()->forget('cart');
        if (Auth::check()) {
            Productcart::where('user_id', Auth::id())->delete();
        }

        return redirect()->route('cart.index')->with('success', 'Payment successful and order placed!');
    }


    public function buyNow(Request $request, $id)
    {
        $product = Product::find($id);
        if (!$product) {
            return redirect()->back()->with('error', 'Product not found');
        }

        $cart = [
            $product->id => [
                'id' => $product->id,
                'name' => $product->name,
                'price' => $product->price,
                'quantity' => 1,
                'image' => $product->image,
            ]
        ];


        session(['pending_order' => [
            'contact' => [
                'email' => Auth::check() ? Auth::user()->email : '',
                'phone' => '',
                'address' => '',
            ],
            'cart' => $cart,
        ]]);

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json(['success' => true]);
        }

        return redirect()->route('orders.payment');
    }
}
