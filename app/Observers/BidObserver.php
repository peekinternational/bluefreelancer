<?php

namespace App\Observers;

use App\Models\Bid;
use App\Models\User;

class BidObserver
{
    /**
     * Handle the Bid "created" event.
     *
     * @param  \App\Models\Bid  $bid
     * @return void
     */
    public function created(Bid $bid)
    {
        $user = User::where('id', $bid->user_id)->first();
        $user->update([
            'bids' => $user->bids - 1,
        ]);
    }

    /**
     * Handle the Bid "updated" event.
     *
     * @param  \App\Models\Bid  $bid
     * @return void
     */
    public function updated(Bid $bid)
    {
        //
    }

    /**
     * Handle the Bid "deleted" event.
     *
     * @param  \App\Models\Bid  $bid
     * @return void
     */
    public function deleted(Bid $bid)
    {
        //
    }

    /**
     * Handle the Bid "restored" event.
     *
     * @param  \App\Models\Bid  $bid
     * @return void
     */
    public function restored(Bid $bid)
    {
        //
    }

    /**
     * Handle the Bid "force deleted" event.
     *
     * @param  \App\Models\Bid  $bid
     * @return void
     */
    public function forceDeleted(Bid $bid)
    {
        //
    }
}
