<?php

namespace App\Http\Controllers;

use App\Models\Wallet;
use App\Models\Withdraw;
use Illuminate\Http\Request;

class WithdrawController extends Controller
{
    public static function store($response)
    {
        // dd($response);
        $withdraw = Withdraw::create([
            'user_id' => auth()->id(),
            'trans_id' => $response->result->items[0]->transaction_id,
            'batch_id' => $response->result->batch_header->payout_batch_id,
            'email' => $response->result->items[0]->payout_item->receiver,
            'amount' => $response->result->batch_header->amount->value,
            'currency' => $response->result->batch_header->amount->currency,
        ]);

        if ($withdraw) {
            $wallet = Wallet::where('user_id', auth()->id())->first();
            $newAmt = $wallet->amt - $withdraw->amount;
            $wallet->update(['amt' => $newAmt]);
            return $withdraw;
        }
    }
}