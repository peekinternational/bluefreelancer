<?php

namespace App\Http\Controllers\Project;

use App\Http\Controllers\Controller;
use App\Http\Controllers\NewFeedController;
use App\Models\Bid;
use App\Models\ChatFriends;
use App\Models\Notification;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Str;


class ProposalController extends Controller
{
    public function index($id)
    {
        $proposals = Bid::where('project_id', $id)->with('user')->get();
        return view('project.manage.proposals', [
            'proposals' => $proposals,
        ]);
    }
    public function store(Request $request)
    {
        $proposal_status = Bid::where('project_id', $request->proposal_project_id)->where('user_id', $request->proposal_user_id)->update(['status' => 2]);
        Notification::create([
            'from' => auth()->id(),
            'to' => $request->proposal_user_id,
            'message' => 'You have been selected for the project. Please notify us to approve the project!',
        ]);
        $conversation = ChatFriends::create([
            'sender_id' => auth()->id(),
            'receiver_id' => $request->proposal_user_id,
            'project_id' => $request->proposal_project_id,
            'conversation_id' => time() . Str::random(9),
            'message_id' => '0',
        ]);

        if ($proposal_status) {
            NewFeedController::store($request->proposal_user_id, 'You have been selected to awarded the ' . Project::where('project_id', $request->proposal_project_id)->first('title')->title . ' please let me know if it is approved. After accepting the project and consulting with the client, if the deposit amount requested by the client is confirmed, the outsourcing will paid the amount to client through the escrow security settlement system according to the contract conditions.');

            return redirect('/inbox?conversation=' . $conversation->conversation_id)->with('message', 'Request Send Successfully!');
        }
    }
    public function update($id)
    {
        $proposal = Bid::find($id);
        $project = Project::where('project_id', $proposal->project_id)->first();
        $proposal = $proposal->update(['status' => 3]);
        $project->update(['status' => 2]);
        Notification::create([
            'from' => auth()->id(),
            'to' => $project->user_id,
            'message' => 'Approved your Project Selection Request!',
        ]);
        if ($proposal) {
            return response()->json([
                'message' => 'Successfully Approved!',
            ]);
        }
    }
    public function destory($id)
    {
        $proposal = Bid::find($id);
        $project = Project::where('project_id', $proposal->project_id)->first();
        $proposal = $proposal->update(['status' => 0]);

        Notification::create([
            'from' => auth()->id(),
            'to' => $project->user_id,
            'message' => 'Rejected your Project Selection Request!',
        ]);
        if ($proposal) {
            return response()->json([
                'message' => 'Successfully Rejected!',
            ]);
        }
    }
}
