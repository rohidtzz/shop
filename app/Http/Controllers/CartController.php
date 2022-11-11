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

        $apiKey = 'DEV-rkmXt6EVoU1HKPimGZkaMQZ820HyTXlm1CNyEbfp';

        // $payload = ['code' => 'BRIVA'];

        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_FRESH_CONNECT  => true,
        CURLOPT_URL            => 'https://tripay.co.id/api-sandbox/merchant/payment-channel',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_HEADER         => false,
        CURLOPT_HTTPHEADER     => ['Authorization: Bearer '.$apiKey],
        CURLOPT_FAILONERROR    => false,
        CURLOPT_IPRESOLVE      => CURL_IPRESOLVE_V4
        ));

        $response = curl_exec($curl);
        $error = curl_error($curl);

        curl_close($curl);

        // echo $response ? $response : $error;

        $mas = json_decode($response)->data;

        // dd($harga);

        return view('cart.cart',compact('product','total','mas'));

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

    public function delete($id)
    {

        $users = Auth()->user()->id;

        $cart = Cart::where('user_id',$users)->where('id',$id)->delete();

        if(!$cart){
            return redirect()->back()->with('errors', 'Delete Product Cart Failed');
        }

        return redirect()->back()->withSuccess('Delete Product Cart Success');

    }

    public function plus($id)
    {

        $users = Auth()->user()->id;

        $cek = Cart::find($id)->first();

        $pr = Product::find($id)->first()->price;




        if($cek->qty == 10){
            return redirect()->back()->with('errors','Product tidak bisa melebihi batas');
        }

        // dd($cek->price + $pr);

        $cart = Cart::where('user_id',$users)->where('id',$id)->update([
            'qty' => $cek->qty+1,
            'subtotal' => $cek->subtotal+$pr
        ]);

        if(!$cart){
            return redirect()->back()->with('errors', 'Tamabah quantity Product Failed');
        }

        return redirect()->back()->withSuccess('tambah Product Success');

    }

    public function minus($id)
    {

        $users = Auth()->user()->id;

        $cek = Cart::find($id)->first();
        $pr = Product::find($id)->first()->price;

        if($cek->qty == 1){
            return redirect()->back()->with('errors','Product tidak bisa dikurangi');
        }

        $cart = Cart::where('user_id',$users)->where('id',$id)->update([
            'qty' => $cek->qty-1,
            'subtotal' => $cek->subtotal-$pr
        ]);



        if(!$cart){
            return redirect()->back()->with('errors', 'Kurangin Product Failed');
        }

        return redirect()->back()->withSuccess('kurangin Product Cart Success');

    }
}
