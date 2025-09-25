<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{
    public function index () {
        if(Auth::check() && Auth::user()->user_type=="users"){
            return view('home');
        }
        else if(Auth::check() && Auth::user()->user_type=="admin"){
            return view('admin.dashboard');
        }
    }
}
