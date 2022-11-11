<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Product;
use App\Models\Cart;

class WelcomeController extends Controller
{

    public function index()
    {

        $product = Product::all();

        $users = Auth()->user()->id;

        $cart = Cart::where('user_id',$users)->count();

        return view('welcome', compact('product','cart'));
    }

}
