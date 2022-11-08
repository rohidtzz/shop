<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Product;

class WelcomeController extends Controller
{

    public function index()
    {

        $apiKey = 'DEV-rkmXt6EVoU1HKPimGZkaMQZ820HyTXlm1CNyEbfp';

        $payload = ['code' => 'BRIVA'];

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_FRESH_CONNECT  => true,
            CURLOPT_URL            => 'https://tripay.co.id/api/merchant/payment-channel?'.http_build_query($payload),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HEADER         => false,
            CURLOPT_HTTPHEADER     => ['Authorization: Bearer '.$apiKey],
            CURLOPT_FAILONERROR    => false,
            CURLOPT_IPRESOLVE      => CURL_IPRESOLVE_V4
        ));

        $response = curl_exec($curl);
        $error = curl_error($curl);

        curl_close($curl);

        dd( empty($error) ? $response : $error);

        $product = Product::all();



        return view('welcome', compact('product'));
    }

}
