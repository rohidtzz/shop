<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Product;
use App\Models\Order;
use App\Models\Cart;

class TransactionController extends Controller
{
    //

    public function store(Request $request)
    {

        // dd($request->all());
        // $product = Product::find($request->product_id);

        $users = Auth()->user()->id;

        if(!Cart::where('user_id',$users)->first()){
            return redirect()->back()->with('errors','invalid');
        }

        // if(!Order::where('user_id',$users)->where('status', 'pending')->get()){
        //     return redirect()->back()->with('errors','invalid');
        // }

        $product = Cart::with('product')->where('user_id',$users)->get();

        $cart = Cart::where('user_id',$users)->get();

        foreach($product as $l){

            $j[] = Product::find($l->product_id);
            $m[] = $l;
            // $m[] = $l;


        }

        // foreach($m as $p){
        //     $h[] = $p->qty;
        // }

        // dd($m);
        // foreach($m as $o){
        //     $f = $o->qty;
        // }

        foreach($m as $k){


                $b[] = [
                    "name" => Product::find($k->product_id)->name,
                    "price" => $k->subtotal,
                    "quantity" => $k->qty
                ];



        }

        Order::create([
            'data' => json_encode($b),
            'user_id' => $users,
            'status' => 'pending'
        ]);



        $product = Order::where('user_id', $users)->get();

        $method = $request->method;
        // dd($request->all());

        $tripay = new TripayController;

        $tipa = $tripay->requestTransaction($method,$product);

        // dd($tipa);

        Cart::where('user_id',$users)->delete();

        return redirect('transaction/'.$tipa->reference);

    }

    public function detail($references)
    {

        $tripay = new TripayController;

        $data = $tripay->detailTransaction($references);

        $total_fee = $data->total_fee;
        $total = $data->amount;
        $payment_method = $data->payment_method;
        // dd($data);

        return view('transaction.detail',compact('data','total_fee','total','payment_method'));

    }
}
