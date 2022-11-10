<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Product;

use App\Models\Cart;

use Auth;

class CartController extends Controller
{
    public function index()
    {

        $users = Auth()->user()->id;
        // $product = Cart::where('user_id',$users)->get();
        $product = Cart::with('product')->where('user_id',$users)->get();

        // dd($product);

        $harga = 0;
        $total = 0;

        foreach ($product as $m=>$value){

            // $quan +=$value['qty'];

            $harga += $value['subtotal'];

            $total = $harga;

        }

        // dd($harga);

        return view('cart.cart',compact('product','total'));

    }


    public function create($id)
    {

        $user = Auth()->user()->id;

        $price = Product::find($id)->price;

        // dd($price);

        $cek = Cart::create([
            'qty' => 1,
            'subtotal' => $price,
            'user_id' => $user,
            'product_id' => $id

        ]);


        return redirect('/cart');
    }
}
