<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Product;

class WelcomeController extends Controller
{

    public function index()
    {

        $product = Product::all();

        return view('welcome', compact('product'));
    }

}
