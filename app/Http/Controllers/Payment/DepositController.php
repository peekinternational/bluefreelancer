<?php

namespace App\Http\Controllers\Payment;

use App\Http\Controllers\Controller;
use App\Http\Controllers\PayPalController;
use Illuminate\Http\Request;

class DepositController extends Controller
{
    public function PaypalDeposit(Request $request)
    {
        $paypal = new PayPalController;
        $paypal->payment($request->paypal_deposit_amt);
    }
}
