<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Education;
use Illuminate\Http\Request;

class EducationController extends Controller
{
    public function show($id)
    {
        return Education::find($id);
    }

    public function store(Request $request)
    {
        $request->validate([
            'country' => 'required',
            'name' => 'required',
            'subjects' => 'required',
            'addmission_year' => 'required',
            'grad_year' => 'required',
        ]);

        $edu = Education::create([
            'country' => $request->country,
            'name' => $request->name,
            'subjects' => $request->subjects,
            'addmission_year' => $request->addmission_year,
            'grad_year' => $request->grad_year,
            'user_id' => auth()->id(),
        ]);

        if ($edu) {
            return response()->json([
                'message' => 'Successfully Added!',
            ]);
        }
    }

    public function update(Request $request)
    {
        $request->validate([
            'country' => 'required',
            'name' => 'required',
            'subjects' => 'required',
            'addmission_year' => 'required',
            'grad_year' => 'required',
        ]);
        Education::where('user_id', auth()->id())
            ->where('id', $request->id)
            ->update([
                'country' => $request->country,
                'name' => $request->name,
                'subjects' => $request->subjects,
                'addmission_year' => $request->addmission_year,
                'grad_year' => $request->grad_year,
            ]);

        return response()->json([
            'message' => 'Successfully Updated!',
        ]);
    }

    public function destory($edu)
    {
        if (Education::find($edu)->delete()) {
            return redirect('/profile?edit_profile=1')->with('message', 'Deleted Successfully!');
        } else {
            return redirect('/profile?edit_profile=1')->with('error', 'Server Error Try Again later!');
        }
    }
}
