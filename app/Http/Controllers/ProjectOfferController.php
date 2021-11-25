<?php

namespace App\Http\Controllers;

use App\Models\Bid;
use App\Models\Escrow;
use App\Models\Milestone;
use App\Models\Notification;
use App\Models\Project;
use App\Models\User;
use App\Models\Wallet;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Crypt;

class ProjectOfferController extends Controller
{
    public function milestoneDeposit(Request $request)
    {
        // Validation Process
        $request->validate([
            'projOfferMsAmount' => 'required',
            'projOfferMsDescription' => 'required',
        ]);
        // Getting Records
        $walletAmt = Wallet::where('user_id', auth()->id())->first('amt');
        // Check is Amount Exist or not
        if ($walletAmt->amt < $request->projOfferMsAmount) {
            return redirect()->back()->with('error', 'You have not enough amount in wallet kindly recharge your wallet!');
        }
        $milestone = Milestone::create([
            'name' => $request->projOfferMsDescription,
            'amount' => $request->projOfferMsAmount,
            'bid_id' => $request->projOfferMsBidId,
            'project_id' => $request->projOfferMsProjectId,
            'user_id' => $request->projOfferMsUserId,
            'status' => 2,
        ]);
        // Create an escrow
        $escrow = Escrow::create([
            'from' => auth()->id(),
            'to' => $request->projOfferMsUserId,
            'amt' => $request->projOfferMsAmount,
            'source_id' => $milestone->id,
            'type' => 1,
        ]);
        if($milestone &&  $escrow){
            Notification::create([
                'from' => auth()->id(),
                'to' => $request->projOfferMsUserId,
                'message' => 'The Milestone is Deposited!',
                'url' => '/project-details/'. $request->projOfferMsProjectId
            ]);
            return redirect()->back()->with('message', 'Project Offer Milestone Deposited Successfully!');
        }
    }

    public function store(Request $request, $id)
    {
        // Validation Process
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'currency' => 'required',
            'fixedRate' => 'required',
            'budget' => 'required',
        ]);
        // Getting User
        $user_id = Crypt::decryptString($id);
        $user = User::find($user_id);

        $currency_symbol = $request->currency == 'USD' ? '$ - $' : '₩ - ₩'; // Setting Currency Symbol

        // Create Project
        $project = Project::create([
            'project_id' => time() . Str::random(9),
            'title' => $request->title,
            'description' => $request->description,
            'skills' => $user->skills,
            'rate_status' => $request->fixedRate,
            'currency' => $request->currency,
            'fixed_rate' => $currency_symbol,
            'min_budget' => 1,
            'max_budget' => $request->budget,
            'status' => 1,
            'user_id' => auth()->id(),
        ]);
        $bid = Bid::create([
            'project_id' => $project->project_id,
            'user_id' => $user_id,
            'day' => 3,
            'budget' => $request->budget,
            'status' => 2,
        ]);
        Notification::create([
            'from' => auth()->id(),
            'to' => $user_id,
            'message' => 'You have been selected for the project. Please notify us to approve the project!',
            'url' => '/project-details/'. $project->project_id
        ]);
        if ($project && $bid) {
            return response()->json([
                'bid' => $bid
            ]);
        }
    }
}
