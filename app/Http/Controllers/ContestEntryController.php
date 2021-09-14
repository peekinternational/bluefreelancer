<?php

namespace App\Http\Controllers;

use App\Models\Contest;
use App\Models\ContestEntry;
use App\Models\Notification;
use Illuminate\Http\Request;

class ContestEntryController extends Controller
{
    public function show($id)
    {
        $contest = ContestEntry::where('id', $id)->with('user')->first();
        return $contest;
    }

    public function store(Request $request)
    {
        // dd($request);
        $request->validate([
            'entry_title' => 'required',
            'entry_details' => 'required',
            'entry_amount' => 'required',
            'entry_file' => 'required|mimes:jpeg,jpg,png|max:1024',
            'entry_contest_id' => 'required',
        ]);
        $request->entry_file = $this->linkImage($request->entry_file);

        $entry = ContestEntry::create([
            'title' => $request->entry_title,
            'detail' => $request->entry_details,
            'amount' => $request->entry_amount,
            'file' => $request->entry_file,
            'contest_id' => $request->entry_contest_id,
            'user_id' => auth()->id(),
            'status' => 1
        ]);

        if ($entry) {
            $contest_user_id = Contest::where('contest_id', $request->entry_contest_id)->first('user_id');

            Notification::create([
                'from' => auth()->id(),
                'to' => $contest_user_id->user_id,
                'message' => 'New Participant in your Contest!',
            ]);
            return redirect()->route('contest-details', $request->entry_contest_id)->with('message', 'You Successfully Participate in contest!');
        }
    }

    public function update($id)
    {
        $contest_entry = ContestEntry::where('id', $id)->first();
        $user_id = $contest_entry->user_id;
        $contest_id = $contest_entry->contest_id;
        if ($contest_entry->update(['status' => 2]) && Contest::where('contest_id', $contest_id)->update(['status' => 2])) {
            Notification::create([
                'from' => auth()->id(),
                'to' => $user_id,
                'message' => 'Congrats! You have been selected in contest.',
            ]);
            return redirect()->route('contest-details', $contest_id)->with('message', 'Participant Successfully Selected!');
        }
    }


    public function unlinkImage($name)
    {
        $filePath = public_path() . '/uploads/contest/entry/' . $name;
        if (file_exists($filePath)) {
            @unlink($filePath);
        }
    }
    public function linkImage($image)
    {
        $imageName = time() . '.' . $image->extension();
        $image->move(public_path('uploads/contest/entry/'), $imageName);
        return $imageName;
    }
}
