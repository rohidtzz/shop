<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Product;
use App\Models\Order;
use App\Models\Cart;
use App\Models\Transaction;

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
            $h = 0;

            // dd($m);

        foreach($m as $k){

            // dd($k);
                $b[] = [
                    "name" => Product::find($k->product_id)->name,
                    "price" => Product::find($k->product_id)->price,
                    "quantity" => 1
                ];



        }

        // dd($b);

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

        // dd($tipa->qr_url);

        Cart::where('user_id',$users)->delete();

        if($tipa->payment_method == 'QRIS' || $tipa->payment_method == 'QRISC' || $tipa->payment_method == 'QRIS2'){
            Transaction::create([
                'amount' => $tipa->amount,
                'reference' => $tipa->reference,
                'merchant_ref' => $tipa->merchant_ref,
                'status' => $tipa->status,
                'user_id' => $users,
                'qr' => $tipa->qr_url,
            ]);
        } else{
            Transaction::create([
                'amount' => $tipa->amount,
                'reference' => $tipa->reference,
                'merchant_ref' => $tipa->merchant_ref,
                'status' => $tipa->status,
                'user_id' => $users
            ]);
        }



        Order::where('user_id',$users)->delete();

        return redirect('transaction/'.$tipa->reference)->withSuccess('Transaction berhasil di buat');

    }

    public function detail($references)
    {

        $tripay = new TripayController;

        $data = $tripay->detailTransaction($references);

        // dd($data);

        if(json_decode($data)->success == false){
            return redirect()->back()->with('errors','reference not found');
        }
            $data = json_decode($data)->data;


        $total_fee = $data->total_fee;
        $total = $data->amount;
        $payment_method = $data->payment_method;

        $qr = Transaction::where('reference',$references)->get('qr')[0]->qr;

        $status = Transaction::where('reference',$references)->first()->status;
        // dd($status);

        if($qr == null){
            $qr = false;
            return view('transaction.detail',compact('data','total_fee','total','payment_method','qr','status'));
        }








        return view('transaction.detail',compact('data','total_fee','total','payment_method','qr','status'));

    }


    public function show()
    {

        $users = Auth()->user()->id;

        $data = Transaction::where('user_id',$users)->paginate(10);



        return view('transaction.daftar',compact('data'));


    }
}
