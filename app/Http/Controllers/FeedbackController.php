<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FeedbackController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'prof_rating' => 'required',
            'com_rating' => 'required',
            'pay_rating' => 'required',
            'clarity_rating' => 'required',
            'emp_rating' => 'required',
            'comp_time' => 'required',
            'comp_budget' => 'required',
            'comments' => 'required',
        ]);

        $feedback = Feedback::create([
            'user_from' => auth()->id(),
            'user_to' => $request->to,
            'type' => $request->type,
            'project_id' => $request->project_id,
            'professionalism' => $request->prof_rating,
            'communication' => $request->com_rating,
            'payment' => $request->pay_rating,
            'clarity_spec' => $request->clarity_rating,
            'emp' => $request->emp_rating,
            'on_time' => $request->comp_time,
            'on_budget' => $request->comp_budget,
            'comments' => $request->comments,
        ]);

        if ($feedback->type == 1) {
            return redirect()->route('project.manage.milestone', $feedback->project_id)->with('message', 'Feedback Submitted!');
        } elseif ($feedback->type == 2) {
            return redirect()->route('project.show', $feedback->project_id)->with('message', 'Feedback Submitted!');
        }
    }

    public function show($user_id, $type)
    {
        // This Function is just for testing purpose!

        // Professionalism Ratings
        $prof_rating = Feedback::where('user_to', $user_id)
            ->avg('professionalism');

        // Communication Ratings
        $comm_rating = Feedback::where('user_to', $user_id)
            ->avg('communication');

        // Payment Ratings
        $pay_rating = Feedback::where('user_to', $user_id)
            ->avg('payment');

        // Clarity Specification Ratings
        $clarity_rating = Feedback::where('user_to', $user_id)
            ->avg('clarity_spec');

        // Employment Ratings
        $emp_rating = Feedback::where('user_to', $user_id)
            ->avg('emp');

        // On Time Rating
        $actual_on_time = Feedback::where('user_to', $user_id)->where('on_time', 1)->count();
        $total_on_time = Feedback::where('user_to', $user_id)->count();

        // On Budget Rating
        $actual_on_budget = Feedback::where('user_to', $user_id)->where('on_budget', 1)->count();
        $total_on_budget = Feedback::where('user_to', $user_id)->count();




        $rating = number_format(($prof_rating + $comm_rating + $pay_rating + $clarity_rating + $emp_rating) / 5 * 1, 2, '.', '');
        $on_time = number_format($actual_on_time / $total_on_time * 100, 2, '.', '');
        $on_budget = number_format($actual_on_budget / $total_on_budget * 100, 2, '.', '');


        dd($on_time);
    }
}
