<?php

namespace App\Observers;

use App\Models\Bid;
use App\Models\Milestone;
use App\Models\Project;
use App\Models\Wallet;

class MilestoneObserver
{
    /**
     * Handle the Milestone "created" event.
     *
     * @param  \App\Models\Milestone  $milestone
     * @return void
     */
    public function created(Milestone $milestone)
    {
        // $wallet = Wallet::where('user_id', auth()->id())->first();
        // $newAmt = $wallet->amt - $milestone->amount;
        // $wallet->update(['amt' => $newAmt]);
        
        // $msAmt = Milestone::where('project_id', $milestone->project_id)->where('status', 4)->sum('amount');
        // $bidAmt = Bid::where('id', $milestone->bid_id)->first();
        // if($msAmt >= $bidAmt->budget){
        //     Project::where('project_id', $milestone->project_id)->update(['status' => 3]);
        // }
        // dd($msAmt);
    }

    /**
     * Handle the Milestone "updated" event.
     *
     * @param  \App\Models\Milestone  $milestone
     * @return void
     */
    public function updated(Milestone $milestone)
    {
        // $wallet = Wallet::where('user_id', auth()->id())->first();
        // $newAmt = $wallet->amt - $milestone->amount;
        // $wallet->update(['amt' => $newAmt]);

        // $msAmt = Milestone::where('project_id', $milestone->project_id)->where('status', 4)->sum('amount');
        // $bid = Bid::where('id', $milestone->bid_id)->first();
        // if($msAmt >= $bid->budget){
        //     // dd("asdasdas");
        //     $bid->update(['status' => 4]);
        //     Project::where('project_id', $milestone->project_id)->update(['status' => 3]);
        //     return redirect()->route('project.feedback?user='.$bid->user_id, $milestone->project_id)->send();
        // }

        // dd($msAmt);
    }

    /**
     * Handle the Milestone "deleted" event.
     *
     * @param  \App\Models\Milestone  $milestone
     * @return void
     */
    public function deleted(Milestone $milestone)
    {
        //
    }

    /**
     * Handle the Milestone "restored" event.
     *
     * @param  \App\Models\Milestone  $milestone
     * @return void
     */
    public function restored(Milestone $milestone)
    {
        //
    }

    /**
     * Handle the Milestone "force deleted" event.
     *
     * @param  \App\Models\Milestone  $milestone
     * @return void
     */
    public function forceDeleted(Milestone $milestone)
    {
        //
    }
}
