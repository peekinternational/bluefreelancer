<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PayPalCheckoutSdk\Core\PayPalHttpClient;
use PayPalCheckoutSdk\Core\SandboxEnvironment;
use PayPalCheckoutSdk\Orders\OrdersCreateRequest;
use PayPalCheckoutSdk\Orders\OrdersCaptureRequest;
use PayPalCheckoutSdk\Orders\OrdersGetRequest;
use Sample\PayPalClient;
// use Srmklive\PayPal\Services\ExpressCheckout;
// use Srmklive\PayPal\Services\PayPal as PayPalClient;
// $provider = new PayPalClient;
// Through facade. No need to import namespaces
// $provider = \PayPal::setProvider();
// $provider = PayPal::setProvider();

class PayPalController extends Controller
{
    /**
     * Responds with a welcome message with instructions
     *
     * @return \Illuminate\Http\Response
     */
    private $client;

    function __construct()
    {

        $environment = new SandboxEnvironment(env('PAYPAL_SANDBOX_CLIENT_ID'), env('PAYPAL_SANDBOX_CLIENT_SECRET'));
        $this->client = new PayPalHttpClient($environment);
        // dd($this->client);
    }


    public function payment(Request $req)
    {
        if ($req->paypal_deposit_amt > 1) {
            if (!auth()->user()->paypal_email) {
                return redirect()->back()->with('error', 'Your Paypal is not verify kindly verify it first!');
            }
        }

        $amt = $req->paypal_deposit_amt;
        $request = new OrdersCreateRequest();
        $request->headers["prefer"] = "return=representation";
        $request->body = PayPalController::checkoutData($amt);
        $response = $this->client->execute($request);
        // dd($response);
        if ($response->statusCode == 201) {
            foreach ($response->result->links as $link) {
                if ($link->rel == 'approve') {
                    return redirect($link->href);
                }
            }
        } else {
            abort(500);
        }
    }

    /**
     * Responds with a welcome message with instructions
     *
     * @return \Illuminate\Http\Response
     */
    public function cancel()
    {
        dd('Your payment is canceled. You can create cancel page here.');
    }

    /**
     * Responds with a welcome message with instructions
     *
     * @return \Illuminate\Http\Response
     */
    public function success(Request $request)
    {
        $req = new OrdersCaptureRequest($request->token);
        $response = $this->client->execute($req);
        if ($response->statusCode == 201 && $response->result->status == 'COMPLETED') {
            $transaction = TransactionController::store($response);
            if ($transaction) {
                if ($transaction->gross_amt == 1) {
                    return redirect('/')->with('message', 'Your Payment Method is Verified!');
                } else {
                    return redirect('/')->with('message', 'Transaction is completed!');
                }
            } else {
                abort(500);
            }
        }
        // dd($response);
    }

    public static function checkoutData($amt)
    {
        return array(
            'intent' => 'CAPTURE',
            'application_context' =>
            array(
                'return_url' => route('payment.success'),
                'cancel_url' => route('payment.cancel')
            ),
            'purchase_units' =>
            array(
                0 =>
                array(
                    'amount' =>
                    array(
                        'currency_code' => 'USD',
                        'value' => $amt,
                    )
                )
            )
        );
    }
}
