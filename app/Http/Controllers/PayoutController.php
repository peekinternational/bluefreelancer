<?php

namespace App\Http\Controllers;

use App\Models\Wallet;
use Illuminate\Http\Request;
use PaypalPayoutsSDK\Core\PayPalHttpClient;
use PaypalPayoutsSDK\Core\SandboxEnvironment;
use PaypalPayoutsSDK\Payouts\PayoutsPostRequest;
use PaypalPayoutsSDK\Payouts\PayoutsGetRequest;

class PayoutController extends Controller
{
    private $client;

    function __construct()
    {
        $environment = new SandboxEnvironment(env('PAYPAL_SANDBOX_CLIENT_ID'), env('PAYPAL_SANDBOX_CLIENT_SECRET'));
        $this->client = new PayPalHttpClient($environment);
        // dd($this->client);
    }

    public function payout(Request $req)
    {
        // Validation Chks
        if ($req->paypal_withdraw_amt < 30) {
            return redirect()->back()->with('error', 'Minimum Withdraw amount is $30.');
        }
        $user_wallet_amt = Wallet::where('user_id', auth()->id())->first()->amt;
        if ($req->paypal_withdraw_amt > $user_wallet_amt) {
            return redirect()->back()->with('error', 'You do not have enough credit in your wallet!');
        }
        if (!auth()->user()->paypal_email) {
            return redirect()->back()->with('error', 'Your Paypal is not verify kindly verify it first!');
        }
        $request = new PayoutsPostRequest();
        $body = json_decode(
            '{
                "sender_batch_header":
                {
                  "email_subject": "Bluefreelancer Withdrawal"
                },
                "items": [
                {
                  "recipient_type": "EMAIL",
                  "receiver": "' . $req->paypal_email . '",
                  "note": "Withdraw from Bluefreelancer!",
                  "sender_item_id": "Test_txn_12",
                  "amount":
                  {
                    "currency": "USD",
                    "value": "' . $req->paypal_withdraw_amt . '"
                  }
                }]
              }',
            true
        );
        // dd($body);
        $request->body = $body;
        $response = $this->client->execute($request);
        // dd($response);
        if ($response->statusCode == 201 || $response->statusCode == 200) {
            $request = new PayoutsGetRequest($response->result->batch_header->payout_batch_id);
            $response = $this->client->execute($request);
        // dd($response);

            if ($response->statusCode == 201 || $response->statusCode == 200) {
                $withdraw = WithdrawController::store($response);
                if ($withdraw) {
                    return redirect()->route('withdraw')->with('message', 'Amount Withdrawal Successfully!')->with('withdrawMessage', 'Thank you! you can withdraw the payment again from here.');
                }
            }
        } else {
            abort(500);
        }
    }
}
