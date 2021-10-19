<?php

namespace App\Observers;

use App\Models\Transaction;
use App\Models\Wallet;

class TransactionObserver
{
    /**
     * Handle the Transaction "created" event.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return void
     */
    public function created(Transaction $transaction)
    {
        $user = Wallet::where('user_id', $transaction->user_id)->first();
        if ($user != '') {
            $newAmt = $user->amt + $transaction->net_amt;
            Wallet::where('user_id', $user->user_id)->update([
                'amt' => $newAmt
            ]);
        } else {
            Wallet::create([
                'user_id' => $transaction->user_id,
                'amt' => $transaction->net_amt,
                'currency_code' => $transaction->currency_code,
            ]);
        }
    }

    /**
     * Handle the Transaction "updated" event.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return void
     */
    public function updated(Transaction $transaction)
    {
        //
    }

    /**
     * Handle the Transaction "deleted" event.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return void
     */
    public function deleted(Transaction $transaction)
    {
        //
    }

    /**
     * Handle the Transaction "restored" event.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return void
     */
    public function restored(Transaction $transaction)
    {
        //
    }

    /**
     * Handle the Transaction "force deleted" event.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return void
     */
    public function forceDeleted(Transaction $transaction)
    {
        //
    }
}
