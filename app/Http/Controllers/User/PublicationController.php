<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Publication;
use Illuminate\Http\Request;

class PublicationController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'title' => 'required',
            'summary' => 'required',
        ]);

        $pub = Publication::create([
            'name' => $request->name,
            'title' => $request->title,
            'summary' => $request->summary,
            'user_id' => auth()->id(),
        ]);

        if ($pub) {
            return response()->json([
                'message' => 'Successfully Added!',
            ]);
        }
    }

    public function show($id)
    {
        return Publication::find($id);
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'title' => 'required',
            'summary' => 'required',
        ]);

        Publication::where('user_id', auth()->id())
            ->where('id', $request->id)
            ->update([
                'name' => $request->name,
                'title' => $request->title,
                'summary' => $request->summary,
            ]);

        return response()->json([
            'message' => 'Successfully Updated!',
        ]);
    }

    public function destory($pub)
    {
        if (Publication::find($pub)->delete()) {
            return redirect('/profile?edit_profile=1')->with('message', 'Deleted Successfully!');
        } else {
            return redirect('/profile?edit_profile=1')->with('error', 'Server Error Try Again later!');
        }
    }
}
