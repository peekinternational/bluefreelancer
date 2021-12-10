<?php

namespace App\Console\Commands;

use App\Models\Dispute;
use App\Models\DisputeConversation;
use App\Models\Milestone;
use App\Models\Wallet;
use Carbon\Carbon;
use Illuminate\Console\Command;

class DisputeOtherPartyRespond extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'dispute:partyRespond';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This Command for disputes which dont get any response from other party in conversation.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $disputes = Dispute::where('status', 1)->get();
        foreach ($disputes as $item) {
            if (Carbon::parse($item->created_at->addDays(4))->diffInDays(now()) == 0) {
                $otherPartyResponse = DisputeConversation::where('dispute_id', $item->id)->where('user_id', $item->to)->count();
                if ($otherPartyResponse == 0) {
                    $user_wallet = Wallet::where('user_id', $item->from)->first();
                    $newAmt = $user_wallet->amt + $item->offer_amt;
                    $user_wallet->update(['amt' => $newAmt]);
                    Dispute::where('id', $item->id)->update(['status' => 3]);
                    Milestone::where('id', $item->milestone_id)->update(['status' => 4]);
                }
            }
        }
    }
}
