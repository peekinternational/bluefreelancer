<?php

namespace App\Http\Controllers;

use App\Mail\DisputeOtherPartyResponseMail;
use App\Models\Dispute;
use App\Models\DisputeConversation;
use App\Models\Notification;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;


class DisputeConversationController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'dispute_cmnt' => 'required',
        ]);
        if ($request->has('dispute_two_file')) {
            $request->validate([
                'dispute_two_file' => 'mimes:doc,docx,zip|max:2048',
            ]);
            $request->dispute_two_file = $this->linkImage($request->dispute_two_file);
        }
        $consultation = DisputeConversation::create([
            'dispute_id' => $request->dispute_id,
            'user_id' => auth()->id(),
            'message' => $request->dispute_cmnt,
            'file' => $request->dispute_two_file,
        ]);
        if ($consultation) {
            $dispute = Dispute::where('id', $consultation->dispute_id)->first();
            if ($dispute->status != 2) {
                if ($dispute->to == $consultation->user_id) {
                    $dispute->update(['status' => 2]);
                    Notification::create([
                        'from' => $dispute->to,
                        'to' => $dispute->from,
                        'message' => 'Other Party responsed on your dispute.',
                        'url' => '/dispute/stage-two/' . base64_encode($dispute->id),
                    ]);
                    // Mail Notify
                    $url = '/dispute/stage-two/' . base64_encode($dispute->id);
                    Mail::to(User::where('id', $dispute->from)->first()->email)->send(new DisputeOtherPartyResponseMail($url));
                }
            }
            return redirect()->back()->with('message', 'Dispute Comment Created!');
        }
    }

    public function linkImage($image)
    {
        $imageName = time() . Str::random(3) . '.' . $image->extension();
        $image->move(public_path('uploads/dispute/'), $imageName);
        return $imageName;
    }
}
