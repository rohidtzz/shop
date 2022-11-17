<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

use App\Models\Address;

class ShippingController extends Controller
{



    public function city()
    {

        $rajaongkir = new RajaOngkirController();

        $raja = $rajaongkir->city()->results;

        // dd($raja);


        return response()->json($raja, 200);
    }

    public function cost(Request $request)
    {
        $rajaongkir = new RajaOngkirController();

        $users = Auth()->user()->id;

        $address = Address::where('user_id',$users)->get()[0];

        // dd($address);

        // $origin = 456;
        // $destinasi = $request->destinasi;
        // $berat = 200;
        // $kurir = $request->kurir;

        $origin = 456;
        $destinasi = $address->city_id;
        $berat = 200;
        $kurir = $request->kurir;

        $raja = $rajaongkir->cost($origin,$destinasi,$berat,$kurir);


        // Response::json([
        //     $raja
        // ]);
        // dd($raja);


        return response()->json($raja, 200);

    }

}
