<?php

namespace App\Http\Controllers;

use App\Models\Bid;
use App\Models\Escrow;
use App\Models\Feedback;
use App\Models\Milestone;
use App\Models\Notification;
use App\Models\Project;
use App\Models\TransactionHistory;
use App\Models\Wallet;
use Illuminate\Http\Request;

class MilestoneController extends Controller
{
    public function depositOrReject(Request $request, $id)
    {
        if ($request->deposit) {
            // Getting Records
            $walletAmt = Wallet::where('user_id', auth()->id())->first('amt');
            $milestone = Milestone::where('id', $id)->first();
            $to = Bid::where('id', $milestone->bid_id)->first('user_id');
            // Check Wallet exsist or not!
            if (!$walletAmt) {
                return redirect()->back()->with('error', 'Kindly verify your paypal account and deposit the amount first!');
            }
            // Check is Amount Exist or not
            if ($walletAmt->amt < $milestone->amount) {
                return redirect()->back()->with('error', 'You have not enough amount in wallet kindly recharge your wallet!');
            }
            // Check Escrow Exist Already!
            if (!Escrow::where('source_id', $id)->where('type', 1)->where('status', 1)->first()) {
                // Create an escrow
                Escrow::create([
                    'from' => auth()->id(),
                    'to' => $to->user_id,
                    'amt' => $milestone->amount,
                    'source_id' => $id,
                    'type' => 1,
                ]);
            }
            // Deduct Amt from Wallet
            MilestoneController::deductAmt($milestone->amount);
            // Update a MS
            $status = $milestone->update(['status' => 2]);

            if ($status) {
                Notification::create([
                    'from' => auth()->id(),
                    'to' => $to->user_id,
                    'message' => 'The Milestone is Deposited!',
                    'url' => '/project-details/'. $request->project_id
                ]);
                TransactionHistory::create([
                    'user_id' => auth()->id(),
                    'transaction' => 'You Deposit the Milestone from your E-Wallet',
                    'amount' => $milestone->amount,
                    'type' => 3,
                    'status' => 2,
                ]);
                return redirect()->back()->with('message', 'Milestone Deposit Successfully!');
            }
        } elseif ($request->reject) {
            $ms = Milestone::where('id', $id)->first();
            $status = $ms->update(['status' => 3]);
            if ($status) {
                Notification::create([
                    'from' => auth()->id(),
                    'to' => $ms->user_id,
                    'message' => 'The Milestone is Rejected!',
                    'url' => '/project-details/'. $request->project_id
                ]);
                return redirect()->back()->with('message', 'Milestone Rejected Successfully!');
            }
        }
    }

    public function deposit(Request $request)
    {
        $request->validate([
            'deposit_amount' => 'required',
            'deposit_name' => 'required',
        ]);
        // Getting Records
        $walletAmt = Wallet::where('user_id', auth()->id())->first('amt');
        // Check Wallet exsist or not!
        if (!$walletAmt) {
            return redirect()->back()->with('error', 'Kindly verify your paypal account and deposit the amount first!');
        }
        // $milestone = Milestone::where('id', $id)->first();
        $to = Bid::where('id', $request->deposit_bid_id)->first('user_id');
        // Check is Amount Exist or not
        if ($walletAmt->amt < $request->deposit_amount) {
            return redirect()->back()->with('error', 'You have not enough amount in wallet kindly recharge your wallet!');
        }
        // Create Milestone
        $milestone = Milestone::create([
            'name' => $request->deposit_name,
            'amount' => $request->deposit_amount,
            'bid_id' => $request->deposit_bid_id,
            'project_id' => $request->deposit_project_id,
            'user_id' => $request->deposit_user_id,
            'status' => 2,
        ]);
        // Deduct Amt from Wallet
        MilestoneController::deductAmt($milestone->amount);
        // Create an escrow
        $escrow = Escrow::create([
            'from' => auth()->id(),
            'to' => $to->user_id,
            'amt' => $request->deposit_amount,
            'source_id' => $milestone->id,
            'type' => 1,
        ]);

        if ($milestone && $escrow) {
            Notification::create([
                'from' => auth()->id(),
                'to' => $to->user_id,
                'message' => 'The Milestone is Deposited!',
                'url' => '/project-details/'. $request->deposit_project_id
            ]);

            TransactionHistory::create([
                'user_id' => auth()->id(),
                'transaction' => 'You Deposit the Milestone from your E-Wallet',
                'amount' => $request->deposit_amount,
                'type' => 3,
                'status' => 2,
            ]);
            return redirect()->back()->with('message', 'Milestone Deposit Successfully!');
        }
    }

    public function ReleaseRefundDispute(Request $request, $id)
    {
        // dd($request);
        // Get Escrow
        $escrow = Escrow::where('source_id', $id)->where('type', 1)->first();
        // Get Milestone
        $ms = Milestone::where('id', $id)->first();
        // User (To) Wallet
        $toUser = Wallet::where('user_id', $escrow->to)->first();
        // User (From) Wallet
        $fromUser = Wallet::where('user_id', $escrow->from)->first();
        // Amount Release
        if ($request->amount_release) {
            $bid = Bid::where('id', $ms->bid_id)->first();
            // $fee =  ($escrow->amt * 0.20) / (1 + 0.20);
            // $net = $escrow->amt / (1 + 0.20);
            if (!$toUser) {
                Wallet::create([
                    'user_id' => $escrow->to,
                    'amt' => $escrow->amt,
                    'currency_code' => 'USD',
                ]);
            } else {
                $newWalletAmt = $toUser->amt + $escrow->amt;
                $toUser->update([
                    'amt' => $newWalletAmt
                ]);
            }
            // Company Wallet
            // $company = Wallet::where('user_id', 1)->first();
            // $companyAmt = $company->amt + $fee;
            // $company->update([
            //     'amt' => $companyAmt
            // ]);
            // Escrow Status Update
            $escrow->update([
                'status' => 2
            ]);
            // Milestone Status Update (status -> Release Amount)
            $ms->update(['status' => 4]);
            // Project Completion when Milestones are paid according to Project's Budget
            $msAmt = Milestone::where('project_id', $request->project_id)->where('status', 4)->sum('amount');
            
            Notification::create([
                'from' => auth()->id(),
                'to' => $toUser->user_id,
                'message' => 'The Milestone is Released!',
                'url' => '/project-details/'. $request->project_id
            ]);
            
            if ($msAmt >= $bid->budget && !Feedback::isExist(auth()->id(), 1, $request->project_id)) {
                $bid->update(['status' => 4]);
                Project::where('project_id', $request->project_id)->update(['status' => 3]);
                return redirect()->route('project.feedback', ['id' => $request->project_id, 'user' => $bid->user_id, 'type' => 1])->with('message', 'Milestone Amount Released, and project also completed now you can give feedback!');
            }

            TransactionHistory::create([
                'user_id' => $toUser->user_id,
                'transaction' => 'You received the Milestone amount in your E-Wallet',
                'amount' => $escrow->amt,
                'type' => 3,
                'status' => 1,
            ]);

            return redirect()->back()->with('message', 'Milestone Amount Released Successfully!');
        } elseif ($request->refund) {
            // Chk if Amount exist
            if ($toUser->amt < $ms->amount) {
                return redirect()->back()->with('error', 'You have not enough amount in wallet!');
            }
            // Subtract from User Who Refund
            $toUserAmount =  $toUser->amt - $ms->amount;
            $toUser->update([
                'amt' => $toUserAmount,
            ]);
            // Added to User Who Collected
            $fromUserAmount =  $fromUser->amt + $ms->amount;
            $fromUser->update([
                'amt' => $fromUserAmount,
            ]);
            // Milestone Update from Paid to Request
            $ms->update([
                'status' => 1
            ]);
            // Escrow Status Update
            $escrow->update([
                'status' => 1
            ]);

            Notification::create([
                'from' => auth()->id(),
                'to' => $fromUser->user_id,
                'message' => 'The Milestone is Refuned!',
                'url' => '/project/'. $request->project_id.'/manage/milestone-manage/'
            ]);

            TransactionHistory::create([
                'user_id' => $fromUser->user_id,
                'transaction' => 'Your Milestone amount is refunded in your E-Wallet',
                'amount' => $ms->amount,
                'type' => 3,
                'status' => 1,
            ]);

            return redirect()->back()->with('message', 'Milestone Amount Refunded Successfully!');
        }
    }

    public static function deductAmt($msAmt)
    {
        $wallet = Wallet::where('user_id', auth()->id())->first();
        $newAmt = $wallet->amt - $msAmt;
        $wallet->update(['amt' => $newAmt]);
    }

    public function destory($id)
    {
        $milestone = Milestone::where('id', $id)->delete();
        if ($milestone) {
            return redirect()->back()->with('message', 'Milestone Successfully Canceled!');
        }
    }
}
