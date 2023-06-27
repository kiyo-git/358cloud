<?php

namespace App\Http\Controllers\Payment;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MethodController extends Controller
{
    /**
     * 支払い方法の振り分け
     */
    public function index(Request $request)
    {
        $method = $request->method;

        if ( $method === 'credit') {
            return redirect()->route('payment.mpi.entry');

        } elseif ( $method === 'paypay') {
            return redirect()->route('payment.paypay.entry');

        } elseif ( $method === 'netbank' ) {
            return redirect()->route('payment.netbank.entry');

        } else {
            abort(403, 'Unauthorized action.');

        }
    }
}
