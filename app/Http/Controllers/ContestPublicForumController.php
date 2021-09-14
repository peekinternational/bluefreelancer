<?php

namespace App\Http\Controllers;

use App\Models\ContestPublicForum;
use Illuminate\Http\Request;

class ContestPublicForumController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'contest_forum_contest_id' => 'required',
            'contest_forum_message' => 'required',
        ]);

        $forum = ContestPublicForum::create([
            'contest_id' => $request->contest_forum_contest_id,
            'user_id' => auth()->id(),
            'message' => $request->contest_forum_message
        ]);

        if($forum){
            return redirect()->back()->with('message', 'Forum Message Send Successfully!');
        }
    }
}
