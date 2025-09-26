<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Order;
use App\Models\Category;
use App\Models\Product;
use App\Models\Productcart;
class UsersController extends Controller
{
    public function index () {
        if(Auth::check() && Auth::user()->user_type=="users"){
            $products = Product::orderBy('created_at', 'desc')->get();
            return view('home', compact('products'));
        }
        else if(Auth::check() && Auth::user()->user_type=="admin"){
            $userOrders = DB::table('orders')
                ->join('users', 'orders.user_id', '=', 'users.id')
                ->select('users.id as user_id', 'users.name', 'users.email', DB::raw('COUNT(orders.id) as total_orders'))
                ->groupBy('users.id', 'users.name', 'users.email')
                ->orderByDesc('total_orders')
                ->get();

            $totalUsers = User::count();
            $totalOrders = Order::count();
            $revenue = DB::table('orders')
                ->join('products', 'orders.product_id', '=', 'products.id')
                ->select(DB::raw('COALESCE(SUM(products.price * orders.quantity), 0) as revenue'))
                ->value('revenue');

            return view('admin.dashboard', compact('userOrders', 'totalUsers', 'totalOrders', 'revenue'));
        }
    }
    public function home(){
        $products = Product::orderBy('created_at', 'desc')->get();
        return view('home', compact('products'));
    }

}
