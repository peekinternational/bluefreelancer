<?php

namespace App\Http\Controllers;

use App\Models\Contest;
use App\Models\ContestHandover;
use App\Models\User;
use Illuminate\Http\Request;

class ContestHandoverController extends Controller
{
    public function index($id)
    {
        $contest = Contest::where('contest_id', $id)->with('contestEntryCompleted')->first();
        // dd($contest);
        return view('contest.contest-handover', [
            'contest' => $contest,
        ]);
    }

    public function store(Request $request, $id)
    {
        $this->validate($request, [
            'handover_file' => 'required|mimes:zip|max:2048',
        ]);
        // dd($request);
        $request->handover_file = $this->linkImage($request->handover_file);
        $handover = ContestHandover::create([
            'file' => $request->handover_file,
            'contest_id' => $id,
            'user_id' => auth()->id(),
        ]);

        if ($handover) {
            return redirect()->route('contest-details', $id)->with('message', 'Contest Handover File Upload Successfully!');
        }
    }

    public function unlinkImage($name)
    {
        $filePath = public_path() . '/uploads/contest/handover/' . $name;
        if (file_exists($filePath)) {
            @unlink($filePath);
        }
    }
    public function linkImage($image)
    {
        $imageName = time() . '.' . $image->extension();
        $image->move(public_path('uploads/contest/handover/'), $imageName);
        return $imageName;
    }
}
