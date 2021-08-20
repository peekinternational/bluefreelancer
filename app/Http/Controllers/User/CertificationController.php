<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Certification;
use Illuminate\Http\Request;

class CertificationController extends Controller
{
    public function show($id)
    {
        return Certification::find($id);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'organization' => 'required',
            'description' => 'required',
            'issue_date' => 'required',
        ]);

        $cert = Certification::create([
            'name' => $request->name,
            'organization' => $request->organization,
            'description' => $request->description,
            'issue_date' => $request->issue_date,
            'user_id' => auth()->id(),
        ]);

        if ($cert) {
            return response()->json([
                'message' => 'Successfully Added!',
            ]);
        }
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'organization' => 'required',
            'description' => 'required',
            'issue_date' => 'required',
        ]);

        Certification::where('user_id', auth()->id())
            ->where('id', $request->id)
            ->update([
                'name' => $request->name,
                'organization' => $request->organization,
                'description' => $request->description,
                'issue_date' => $request->issue_date,
            ]);

        return response()->json([
            'message' => 'Successfully Updated!',
        ]);
    }

    public function destory($cert)
    {
        if (Certification::find($cert)->delete()) {
            return redirect('/profile?edit_profile=1')->with('message', 'Deleted Successfully!');
        } else {
            return redirect('/profile?edit_profile=1')->with('error', 'Server Error Try Again later!');
        }
    }
}
