<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Category;
use App\Models\Product;
class UsersController extends Controller
{
    public function index () {
        if(Auth::check() && Auth::user()->user_type=="users"){
            $products = Product::orderBy('created_at', 'desc')->get();
            return view('home', compact('products'));
        }
        else if(Auth::check() && Auth::user()->user_type=="admin"){
            return view('admin.dashboard');
        }
    }
    public function home(){
        $products = Product::orderBy('created_at', 'desc')->get();
        return view('home', compact('products'));
    }
}
