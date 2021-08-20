<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Experience;

class ExperienceController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'companyname' => 'required',
            'started_at' => 'required',
            'summary' => 'required',
        ]);

        $experience = Experience::create([
            'title' => $request->title,
            'companyname' => $request->companyname,
            'started_at' => $request->started_at,
            'work_status' => $request->work_status,
            'completion_at' => $request->completion_at,
            'summary' => $request->summary,
            'user_id' => auth()->id(),
        ]);

        if ($experience) {
            return response()->json([
                'message' => 'Successfully Added!',
            ]);
        }
    }

    public function show($id)
    {
        return Experience::find($id);
    }

    public function update(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'companyname' => 'required',
            'started_at' => 'required',
            'summary' => 'required',
        ]);

        Experience::where('user_id', auth()->id())
            ->where('id', $request->id)
            ->update([
                'title' => $request->title,
                'companyname' => $request->companyname,
                'started_at' => $request->started_at,
                'completion_at' => $request->completion_at,
                'summary' => $request->summary,
                'work_status' => $request->work_status
            ]);

        return response()->json([
            'message' => 'Successfully Updated!',
        ]);
    }

    public function destory($exp)
    {
        if (Experience::find($exp)->delete()) {
            return redirect('/profile?edit_profile=1')->with('message', 'Deleted Successfully!');
        } else {
            return redirect('/profile?edit_profile=1')->with('error', 'Server Error Try Again later!');
        }
    }
}
