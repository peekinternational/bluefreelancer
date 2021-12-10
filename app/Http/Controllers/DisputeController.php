<?php

namespace App\Http\Controllers;

use App\Mail\DisputeAcceptOfferMail;
use App\Mail\DisputeCancelMail;
use App\Mail\DisputeFiledMail;
use App\Models\Dispute;
use App\Models\DisputeArbitration;
use App\Models\DisputeConversation;
use App\Models\Milestone;
use App\Models\Notification;
use App\Models\Project;
use App\Models\User;
use App\Models\Wallet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class DisputeController extends Controller
{
    public function stageOne($to, $milestone_id)
    {
        $ms = Milestone::where('id', base64_decode($milestone_id))->first();
        $project_name = Project::where('project_id', $ms->project_id)->first('title');
        $to_name = User::where('id', base64_decode($to))->first('username');
        return view('dispute.stage-one', [
            'project_name' => $project_name->title,
            'project_id' => $ms->project_id,
            'to_name' => $to_name->username,
            'ms_amt' => $ms->amount,
        ]);
    }
    public function stageTwo($id)
    {
        $dispute = Dispute::where('id', base64_decode($id))->first();
        $disputeConversation = DisputeConversation::where('dispute_id', $dispute->id)->get();
        return view('dispute.stage-two', [
            'dispute' => $dispute,
            'disputeConversation' => $disputeConversation,
        ]);
    }
    public function stageThree($id)
    {
        $dispute = Dispute::where('id', base64_decode($id))->first();
        $disputeConversation = DisputeConversation::where('dispute_id', $dispute->id)->get();
        $disputeArbitration = DisputeArbitration::where('dispute_id', $dispute->id)->first();
        return view('dispute.stage-three', [
            'dispute' => $dispute,
            'disputeConversation' => $disputeConversation,
            'disputeArbitration' => $disputeArbitration,
        ]);
    }
    public function store(Request $request)
    {
        global $client_offer, $freelancer_offer;
        // dd($request);
        $request->validate([
            'dispute_type' => 'required',
            'dispute_req_evidence' => 'required',
            'dispute_req_solution' => 'required',
            'dispute_one_file' => 'required|mimes:doc,docx,zip|max:2048',
            'dispute_offer_amt' => 'required',
        ]);
        if ($request->ms_amt < $request->dispute_offer_amt) {
            return redirect()->back()->with('error', 'Your offer amount is greater than the Milestone amount, kindly reduce it!');
        }
        $request->dispute_one_file = $this->linkImage($request->dispute_one_file);
        // Offer Check
        if (Dispute::clientDispute($request->project_id)) {
            $client_offer = $request->dispute_offer_amt;
        } else {
            $freelancer_offer = $request->dispute_offer_amt;
        }
        $dispute = Dispute::create([
            'from' => auth()->id(),
            'to' => $request->to,
            'client_id' => Dispute::getClient($request->project_id),
            'freelancer_id' => Dispute::getFreelancer($request->milestone_id),
            'milestone_id' => $request->milestone_id,
            'project_id' => $request->project_id,
            'type' => $request->dispute_type,
            'req_evidence_detail' => $request->dispute_req_evidence,
            'req_solution_detail' => $request->dispute_req_solution,
            'file' => $request->dispute_one_file,
            'offer_amt' => $request->dispute_offer_amt,
            'freelancer_offer_amt' => $freelancer_offer ? $freelancer_offer : null,
            'client_offer_amt' => $client_offer ? $client_offer : null,
        ]);
        if ($dispute) {
            // Milestone update to dispute
            Milestone::where('id', $request->milestone_id)->update(['status' => 5]);
            // Notify to User
            Notification::create([
                'from' => auth()->id(),
                'to' => $request->to,
                'message' => 'The Dispute is created against you by ' . User::where('id', auth()->id())->first()->username,
                'url' => '/dispute/stage-two/' . base64_encode($dispute->id),
            ]);
            // Mail Notify
            $url = 'http://localhost:8000/dispute/stage-two/' . base64_encode($dispute->id);
            Mail::to(User::where('id', $request->to)->first()->email)->send(new DisputeFiledMail($url));
            return redirect()->route('dispute.stage-two', base64_encode($dispute->id))->with('message', 'Dispute Create Successfully!');
        }
    }

    public function newOffer(Request $request)
    {
        $dispute  = Dispute::where('id', $request->dispute_id)->first();

        if ($dispute->offer_amt < $request->dispute_new_offer_amt) {
            return redirect()->back()->with('error', 'Your offer amount is greater than the total amount!');
        }

        if ($dispute->client_id == auth()->id()) {
            $dispute->update([
                'client_offer_amt' => $request->dispute_new_offer_amt
            ]);
        } elseif ($dispute->freelancer_id == auth()->id()) {
            $dispute->update([
                'freelancer_offer_amt' => $request->dispute_new_offer_amt
            ]);
        }

        return redirect()->back()->with('message', 'New Offer Created Successfully!');
    }

    public function acceptOffer(Request $request)
    {
        // Get Records
        $dispute = Dispute::where('id', $request->dispute_id)->first();
        $ms = Milestone::where('id', $dispute->milestone_id)->first();

        // Remaining Amt from main MS Amt
        $remaining_amt = $ms->amount - $request->accept_offer_amt;
        // Get Client's Wallet and Process it
        $client_wallet = Wallet::where('user_id', $dispute->client_id)->first();
        $client_amt = $client_wallet->amt + $remaining_amt;
        $client_wallet->update([
            'amt' => $client_amt
        ]);

        // Get The wallet who Filed the Dispute and process it
        $from_wallet = Wallet::where('user_id', $dispute->from)->first();
        $from_amt = $from_wallet->amt + $request->accept_offer_amt;
        $from_wallet->update([
            'amt' => $from_amt
        ]);

        if ($dispute->update(['status' => 3]) && $ms->update(['status' => 4])) {
            Notification::create([
                'from' => auth()->id(),
                'to' => $dispute->to,
                'message' => 'Dispute Has been Resolved!. Project: ' . Project::where('project_id', $dispute->project_id)->first()->title,
                'url' => '/project-details/' . $dispute->project_id,
            ]);
            // Mail Notify
            $url = '/project-details/' . $dispute->project_id;
            Mail::to(User::where('id', $dispute->to)->first()->email)->send(new DisputeAcceptOfferMail($url));

            Notification::create([
                'from' => auth()->id(),
                'to' => $dispute->from,
                'message' => 'Dispute Has been Resolved!. Project: ' . Project::where('project_id', $dispute->project_id)->first()->title,
                'url' => '/project-details/' . $dispute->project_id,
            ]);
            // Mail Notify
            $url = '/project-details/' . $dispute->project_id;
            Mail::to(User::where('id', $dispute->from)->first()->email)->send(new DisputeAcceptOfferMail($url));

            return redirect()->back()->with('message', 'Offer Accepted! and Dispute Has been Resolved');
        }
    }

    public function cancel($id)
    {
        $dispute = Dispute::where('id', $id)->first();
        $ms = Milestone::where('id', $dispute->milestone_id)->update(['status' => 2]);
        if ($dispute->update(['status' => 3]) && $ms) {
            Notification::create([
                'from' => auth()->id(),
                'to' => $dispute->to,
                'message' => 'Dispute Has been Resolved!. Project: ' . Project::where('project_id', $dispute->project_id)->first()->title,
                'url' => '/project-details/' . $dispute->project_id,
            ]);
            // Mail Notify
            $url = '/project-details/' . $dispute->project_id;
            Mail::to(User::where('id', $dispute->to)->first()->email)->send(new DisputeCancelMail($url));
            return redirect()->back()->with('message', 'Dispute Canceled & Dispute Has been Resolved');
        }
    }

    public function linkImage($image)
    {
        $imageName = time() . Str::random(3) . '.' . $image->extension();
        $image->move(public_path('uploads/dispute/'), $imageName);
        return $imageName;
    }
}
