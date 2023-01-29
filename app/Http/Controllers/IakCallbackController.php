<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class IakCallbackController extends Controller
{
    public function handle(Request $request)
    {
        dd($request->all());




        /*
        |--------------------------------------------------------------------------
        | Proses callback untuk open payment
        |--------------------------------------------------------------------------
        */

        // $invoice = Invoice::where('unique_ref', $uniqueRef)
        //     ->where('status', 'UNPAID')
        //     ->first();

        // if (! $invoice) {
        //     return Response::json([
        //         'success' => false,
        //         'message' => 'Invoice not found or current status is not UNPAID',
        //     ]);
        // }

        // if ((int) $data->total_amount !== (int) $invoice->total_amount) {
        //     return Response::json([
        //         'success' => false,
        //         'message' => 'Invalid amount. Expected: ' . $invoice->total_amount . ' - Got: ' . $data->total_amount,
        //     ]);
        // }

        // switch ($data->status) {
        //     case 'PAID':
        //         $invoice->update(['status' => 'PAID']);
        //         return Response::json(['success' => true]);

        //     case 'EXPIRED':
        //         $invoice->update(['status' => 'EXPIRED']);
        //         return Response::json(['success' => true]);

        //     case 'FAILED':
        //         $invoice->update(['status' => 'FAILED']);
        //         return Response::json(['success' => true]);

        //     default:
        //         return Response::json([
        //             'success' => false,
        //             'message' => 'Unrecognized payment status',
        //         ]);
        // }
    }
}
