<?php

namespace App\Http\Controllers;

use App\Models\Bid;
use App\Models\Milestone;
use App\Models\Project;
use Illuminate\Http\Request;

class BidController extends Controller
{
    public function show($id)
    {
        $bid = Bid::where('id', $id)->with(['milestones'])->first();
        $project = Project::where('project_id', $bid->project_id)->first();
        // dd($project);
        return view('project.edit-bid', [
            'bid' => $bid,
            'project' => $project,
        ]);
    }
    public function store(Request $request)
    {
        // dd($request);
        $request->validate([
            'budget' => 'required',
            'days' => 'required',
            'proposal' => 'required',
        ]);
        if (auth()->user()->bids != '') {
            $bid = Bid::create([
                'project_id' => $request->project_id,
                'user_id' => auth()->id(),
                'budget' => $request->budget,
                'day' => $request->days,
                'proposal' => $request->proposal,
                'status' => 1,
            ]);
            if ($request->milestone_name && $request->milestone_amt) {
                for ($i = 0; $i < count($request->milestone_name); $i++) {
                    Milestone::create([
                        'bid_id' => $bid->id,
                        'project_id' => $request->project_id,
                        'user_id' => auth()->id(),
                        'name' => $request->milestone_name[$i],
                        'amount' => $request->milestone_amt[$i],
                    ]);
                }
            }
            if ($bid) {
                return redirect()->route('project.show', $request->project_id)->with('message', 'Bid Placed Successfully!');
            }
        } else {
            return redirect()->route('project.show', $request->project_id)->with('error', 'You Dont have enough Bids to bid on this Project!');
        }
    }
    
    public function update(Request $request, $id)
    {
        // dd($request);
        $request->validate([
            'budget' => 'required',
            'days' => 'required',
            'proposal' => 'required',
        ]);
        $bid = Bid::find($id);
        if ($request->milestone_name && $request->milestone_amt) {
            for ($i = 0; $i < count($request->milestone_name); $i++) {
                if (isset($request->milestoneId[$i])) {
                    Milestone::where('id', $request->milestoneId[$i])->update([
                        'name' => $request->milestone_name[$i],
                        'amount' => $request->milestone_amt[$i],
                    ]);
                } else {
                    Milestone::create([
                        'bid_id' => $bid->id,
                        'project_id' => $request->project_id,
                        'user_id' => auth()->id(),
                        'name' => $request->milestone_name[$i],
                        'amount' => $request->milestone_amt[$i],
                    ]);
                }
            }
        }
        $bid->update([
            'budget' => $request->budget,
            'day' => $request->days,
            'proposal' => $request->proposal,
        ]);
        if ($bid) {
            return redirect()->route('project.show', $request->project_id)->with('message', 'Bid Updated Successfully!');
        }
    }

    public function destory($id)
    {
        $bid = Bid::find($id);
        Milestone::where('project_id', $bid->project_id)
            ->where('user_id', $bid->user_id)->delete();
        if ($bid->delete()) {
            return redirect()->route('project-listing')->with('message', 'Deleted Successfully!');
        }
    }
}
