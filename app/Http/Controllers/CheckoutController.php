<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Cart;

class CheckoutController extends Controller
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

            // dd($mas);







        return view('checkout.checkout',compact('product','total','mas'));

    }



}
