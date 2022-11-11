<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Product;
use App\Models\Order;

class TransactionController extends Controller
{
    //

    public function store(Request $request)
    {

            // dd($request->all());
        // $product = Product::find($request->product_id);

        if(Cart::where('user_id',$users)->get()){
            return redirect()->back()->with('errors','invalid');
        }

        if(Order::where('user_id',$users)->where('status', 'pending')->get()){
            return redirect()->back()->with('errors','invalid');
        }

        $users = Auth()->user()->id;

        $product = Order::where('user_id', $users)->get();

        $method = $request->method;
        // dd($request->all());

        $tripay = new TripayController;

        $tripay->requestTransaction($method,$product);

    }
}
