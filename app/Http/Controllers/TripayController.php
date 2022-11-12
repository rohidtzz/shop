<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TripayController extends Controller
{
    //

    public function requestTransaction($method,$product)
    {

        $ms = json_decode($product,true)[0];
        $mk = json_decode($ms['data'],true);

        $j = 0;
        foreach($mk as $k){

            $j += $k['price'];


        }
        // dd($j);


        $apiKey       = env('TRIPAY_API_KEY');
        $privateKey   = env('TRIPAY_PRIVATE_KEY');
        $merchantCode = env('TRIPAY_MERCHANT_CODE');
        $merchantRef  = 'PX-'.time();
        $amount       = $j;

        $user = auth()->user();


        $data = [
            'method'         => $method,
            'merchant_ref'   => $merchantRef,
            'amount'         => $amount,
            'customer_name'  => $user->name,
            'customer_email' => $user->email,
            'customer_phone' => (string)$user->no_hp,
            'order_items'    =>  $mk,
                // [
                //     'name'        => $product->name,
                //     'price'       => $product->price,
                //     'quantity'    => 1,
                // ],
                // [
                //     'name'        => $product->name,
                //     'price'       => $product->price,
                //     'quantity'    => 1,
                // ]
                // ],
            // 'return_url'   => 'https://domainanda.com/redirect',
            'expired_time' => (time() + (24 * 60 * 60)), // 24 jam
            'signature'    => hash_hmac('sha256', $merchantCode.$merchantRef.$amount, $privateKey)
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

    public function detailTransaction($references)
    {

        $apiKey = env('TRIPAY_API_KEY');

        $payload = ['reference'	=> $references];

        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_FRESH_CONNECT  => true,
            CURLOPT_URL            => 'https://tripay.co.id/api-sandbox/transaction/detail?'.http_build_query($payload),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HEADER         => false,
            CURLOPT_HTTPHEADER     => ['Authorization: Bearer '.$apiKey],
            CURLOPT_FAILONERROR    => false,
            CURLOPT_IPRESOLVE      => CURL_IPRESOLVE_V4
        ]);

        $response = curl_exec($curl);
        $error = curl_error($curl);

        curl_close($curl);

        // echo empty($error) ? $response : $error;

        // dd($response);

        $response = json_decode($response)->data;

        return  $response ? $response : $error;


    }

    public function kalkulator($total,$code)
    {

        $apiKey = env('TRIPAY_API_KEY');

        $payload = [
            'code' => $code,
            'amount' => $total,
        ];

        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_FRESH_CONNECT  => true,
            CURLOPT_URL            => 'https://tripay.co.id/api-sandbox/merchant/fee-calculator?'.http_build_query($payload),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HEADER         => false,
            CURLOPT_HTTPHEADER     => ['Authorization: Bearer '.$apiKey],
            CURLOPT_FAILONERROR    => false,
            CURLOPT_IPRESOLVE      => CURL_IPRESOLVE_V4
        ]);

        $response = curl_exec($curl);
        $error = curl_error($curl);

        curl_close($curl);

        // echo empty($error) ? $response : $error;

        // dd($response);
        $response = json_decode($response)->data;

        return  $response ? $response : $error;


    }


    public function daftarTransaction()
    {


        $apiKey = env('TRIPAY_API_KEY');

        $payload = [
            'page' => 1,
            'per_page' => 25,
        ];

        $curl = curl_init();

        curl_setopt_array($curl, [
        CURLOPT_FRESH_CONNECT  => true,
        CURLOPT_URL            => 'https://tripay.co.id/api/merchant/transactions?'.http_build_query($payload),
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_HEADER         => false,
        CURLOPT_HTTPHEADER     => ['Authorization: Bearer '.$apiKey],
        CURLOPT_FAILONERROR    => false,
        CURLOPT_IPRESOLVE      => CURL_IPRESOLVE_V4
        ]);

        $response = curl_exec($curl);
        $error = curl_error($curl);

        curl_close($curl);

        // echo empty($err) ? $response : $error;
        $response = json_decode($response)->data;

        return  $response ? $response : $error;




    }
}
