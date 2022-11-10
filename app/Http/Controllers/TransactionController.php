<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Product;

class TransactionController extends Controller
{
    //

    public function store(Request $request)
    {

            // dd($request->all());
        $product = Product::find($request->product_id);
        $method = $request->method;

        $tripay = new TripayController;

        $tripay->requestTransaction($method,$product);

    }
}
