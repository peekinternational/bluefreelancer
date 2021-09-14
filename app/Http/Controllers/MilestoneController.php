<?php

namespace App\Http\Controllers;

use App\Models\Milestone;
use Illuminate\Http\Request;

class MilestoneController extends Controller
{
    public function depositOrReject(Request $request, $id)
    {
        if ($request->deposit) {
            $status = Milestone::where('id', $id)->update(['status' => 2]);
            if ($status) {
                return redirect()->route('project.manage', $request->project_id)->with('message', 'Milestone Deposit Successfully!');
            }
        } elseif ($request->reject) {
            $status = Milestone::where('id', $id)->update(['status' => 3]);
            if ($status) {
                return redirect()->route('project.manage', $request->project_id)->with('message', 'Milestone Rejected Successfully!');
            }
        }
    }

    public function deposit(Request $request)
    {
        $request->validate([
            'deposit_amount' => 'required',
            'deposit_name' => 'required',
        ]);

        $milestone = Milestone::create([
            'name' => $request->deposit_name,
            'amount' => $request->deposit_amount,
            'bid_id' => $request->deposit_bid_id,
            'project_id' => $request->deposit_project_id,
            'user_id' => $request->deposit_user_id,
            'status' => 2,
        ]);
        if ($milestone) {
            return redirect()->back()->with('message', 'Milestone Deposit Successfully!');
        }
    }

    public function destory($id)
    {
        $milestone = Milestone::where('id', $id)->delete();
        if ($milestone) {
            return redirect()->back()->with('message', 'Milestone Successfully Canceled!');
        }
    }
}
