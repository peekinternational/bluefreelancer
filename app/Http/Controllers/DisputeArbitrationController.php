<?php

namespace App\Http\Controllers;

use App\Mail\DisputeAdminArbitrationMail;
use App\Mail\DisputeArbitrationMail;
use App\Models\Dispute;
use App\Models\DisputeArbitration;
use App\Models\Notification;
use App\Models\User;
use App\Models\Wallet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class DisputeArbitrationController extends Controller
{
    public function store($id)
    {
        $wallet = Wallet::where('id', auth()->id())->first();
        if ($wallet->amt < 25) {
            return redirect()->back()->with('error', 'You dont have enough amount in your wallet for arbitration fee!');
        }

        $newAmt = $wallet->amt - 25;
        $wallet->update(['amt' => $newAmt]);

        $arbitration = DisputeArbitration::create([
            'dispute_id' => $id,
            'user_id' => auth()->id(),
            'status' => 1,
        ]);

        if ($arbitration) {
            $dispute = Dispute::where('id', $id)->first();

            $dispute->from == auth()->id() ? $user_to = $dispute->to : $user_to = $dispute->from;

            Notification::create([
                'from' => auth()->id(),
                'to' => $user_to,
                'message' => 'The other party proceed the dispute into an arbitration stage!',
                'url' => '/dispute/stage-three/' . base64_encode($dispute->id),
            ]);
            // Mail Notify
            $url = '/dispute/stage-three/' . base64_encode($dispute->id);
            Mail::to(User::where('id', $user_to)->first()->email)->send(new DisputeArbitrationMail($url));

            if (DisputeArbitration::count($dispute->id)) {
                $dispute->update(['status' => 4]);
                // Mail Notify
                $url = '/disputes';
                Mail::to('admin@bluefreelancer')->send(new DisputeAdminArbitrationMail($url));
            }

            return redirect()->route('dispute.stage-three', base64_encode($dispute->id))->with('message', 'Dispute Arbitration is Created!');
        }
    }
}
