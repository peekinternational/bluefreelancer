<?php

namespace App\Http\Controllers;

use App\Models\Contest;
use App\Models\ContestEntry;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ContestController extends Controller
{
    public function index(Request $request)
    {
        $contests = new Contest();

        if ($request->has('search_contest_by_title') || $request->has('search_contest_by_skills')) {
            $contests = $contests->where('title', 'like', '%' . $request->search_contest_by_title . '%')
                ->where('skills', 'like', '%' . $request->search_contest_by_skills . '%')->with('contestEntries')
                ->orderByDesc('created_at')->paginate(5);
        } else {
            $contests = $contests->with('contestEntries')->orderByDesc('created_at')->paginate(5);
        }
        $contest_completed = Contest::where('status', 2)->with(['user', 'contestEntryCompleted'])->orderBy('created_at', 'desc')->limit(4)->get();
        // dd($contest_completed);
        return view('contest.contest-listing', [
            'contests' => $contests,
            'contest_completed' => $contest_completed
        ]);
    }

    public function show($id)
    {
        $contest = Contest::where('contest_id', $id)->with(['user', 'ContestPublicForums'])->first();
        $contest_similar = Contest::where('main_category', $contest->main_category)->latest()->get();
        $contest_entry = ContestEntry::where('contest_id', $id)->with('user')->get();
        $contest_entry_winner = ContestEntry::where('contest_id', $id)->where('status', 2)->first();
        $contest_selected = Contest::where('status', 2)->with('user')->orderBy('created_at', 'desc')->limit(5)->get();
        // dd($contest_entry_winner);
        return view('contest.contest-details', [
            'contest' => $contest,
            'contest_similar' => $contest_similar,
            'contest_entry' => $contest_entry,
            'contest_selected' => $contest_selected,
            'contest_entry_winner' => $contest_entry_winner,
        ]);
    }

    public function edit($id)
    {
        $contest = Contest::where('contest_id', $id)->first();
        return view('contest.contest-edit', [
            'contest' => $contest,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'contest_description' => 'required',
            'contest_skills' => 'required',
            'main_category' => 'required',
            'sub_category' => 'required',
            'currency' => 'required',
            'budget' => 'required',
        ]);
        if ($request->hasFile("file")) {
            $this->validate($request, [
                'file' => 'required|mimes:jpeg,jpg,png,doc,docx,pdf|max:1024',
            ]);
            $request->file = $this->linkImage($request->file);
        }
        $contest = Contest::create([
            'contest_id' => time() . Str::random(9),
            'title' => $request->title,
            'description' => $request->contest_description,
            'skills' => $request->contest_skills,
            'image' => $request->image,
            'main_category' => $request->main_category,
            'sub_category' => $request->sub_category,
            'currency' => $request->currency,
            'budget' => $request->budget,
            'days' => $request->days,
            'file' => $request->file,
            'status' => 1,
            'user_id' => auth()->id(),
        ]);

        if ($contest) {
            return redirect()->route('contest-details', $contest->contest_id)->with('message', 'Contest Registered Successfully!');
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'contest_title' => 'required',
            'contest_description' => 'required',
        ]);
        $contest = Contest::where('contest_id', $id)->update([
            'title' => $request->contest_title,
            'description' => $request->contest_description,
        ]);
        if ($contest) {
            return redirect()->back()->with('message', 'Contest Update Successfully!');
        }
    }

    public function destory($id)
    {
        if (Contest::where('contest_id', $id)->delete()) {
            return redirect()->route('contest-listing')->with('message', 'Contest Has been Deleted Successfully!');
        }
    }
    // =================================
    // ------- Common Functions --------
    // =================================
    public function unlinkImage($name)
    {
        $filePath = public_path() . '/uploads/contest/images/' . $name;
        if (file_exists($filePath)) {
            @unlink($filePath);
        }
    }
    public function linkImage($image)
    {
        $imageName = time() . '.' . $image->extension();
        $image->move(public_path('uploads/contest/images/'), $imageName);
        return $imageName;
    }
}
