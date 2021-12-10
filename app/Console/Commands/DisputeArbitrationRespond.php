<?php

namespace App\Console\Commands;

use App\Models\Dispute;
use App\Models\DisputeArbitration;
use App\Models\DisputeConversation;
use App\Models\Milestone;
use App\Models\Wallet;
use Carbon\Carbon;
use Illuminate\Console\Command;

class DisputeArbitrationRespond extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'dispute:arbitration';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This Command for disputes which dont get any response from other party for arbitration.';

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

        $disputes = Dispute::where('status', 2)->get();
        foreach ($disputes as $item) {
            $arbitrations = DisputeArbitration::where('dispute_id', $item->id)->get();
            if ($arbitrations->count() < 2) {
                foreach ($arbitrations as $arbi) {
                    if (Carbon::parse($arbi->created_at->addDays(4))->diffInDays(now()) == 0) {
                        if ($arbi->user_id == $item->from) {
                            $user_wallet = Wallet::where('user_id', $item->from)->first();
                            $newAmt = $user_wallet->amt + $item->offer_amt + 25;
                            $user_wallet->update(['amt' => $newAmt]);
                            Dispute::where('id', $item->id)->update(['status' => 3]);
                            Milestone::where('id', $item->milestone_id)->update(['status' => 4]);
                        } elseif ($arbi->user_id == $item->to) {
                            $user_wallet = Wallet::where('user_id', $item->to)->first();
                            $newAmt = $user_wallet->amt + $item->offer_amt + 25;
                            $user_wallet->update(['amt' => $newAmt]);
                            Dispute::where('id', $item->id)->update(['status' => 3]);
                            Milestone::where('id', $item->milestone_id)->update(['status' => 4]);
                        }
                    }
                }
            }
        }
    }
}
