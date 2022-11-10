<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TripayController extends Controller
{
    //

    public function requestTransaction($method,$product)
    {



        $apiKey       = 'DEV-rkmXt6EVoU1HKPimGZkaMQZ820HyTXlm1CNyEbfp';
        $privateKey   = 'ZH3sJ-lGok9-l0GLk-1fF8h-UPBX7';
        $merchantCode = 'T16098';
        $merchantRef  = 'PX-'.time();
        // $amount       = 1000000;

        $user = auth()->user();

        $data = [
            'method'         => $method,
            'merchant_ref'   => $merchantRef,
            'amount'         => $product->price,
            'customer_name'  => $user->name,
            'customer_email' => $user->email,
            'customer_phone' => $user->no_hp,
            'order_items'    => [
                [
                    'name'        => $product->name,
                    'price'       => $product->price,
                    'quantity'    => 1,
                ]
                // [
                //     'name'        => $product->name,
                //     'price'       => $book->price,
                //     'quantity'    => 1,
                // ]
            ],
            // 'return_url'   => 'https://domainanda.com/redirect',
            'expired_time' => (time() + (24 * 60 * 60)), // 24 jam
            'signature'    => hash_hmac('sha256', $merchantCode.$merchantRef.$product->price, $privateKey)
        ];

        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_FRESH_CONNECT  => true,
            CURLOPT_URL            => 'https://tripay.co.id/api-sandbox/transaction/create',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HEADER         => false,
            CURLOPT_HTTPHEADER     => ['Authorization: Bearer '.$apiKey],
            CURLOPT_FAILONERROR    => false,
            CURLOPT_POST           => true,
            CURLOPT_POSTFIELDS     => http_build_query($data),
            CURLOPT_IPRESOLVE      => CURL_IPRESOLVE_V4
        ]);

        $response = curl_exec($curl);
        $error = curl_error($curl);

        curl_close($curl);

        // dd($response);
        $response = json_decode($response)->data;
        // dd($response);

        return $response ? $response:$error;



    }
}
