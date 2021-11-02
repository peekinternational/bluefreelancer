<?php

namespace App\Observers;

use App\Models\Feedback;
use App\Models\User;

class FeedbackObserver
{
    /**
     * Handle the Feedback "created" event.
     *
     * @param  \App\Models\Feedback  $feedback
     * @return void
     */
    public function created(Feedback $feedback)
    {
        // Professionalism Ratings
        $prof_rating = Feedback::where('user_to', $feedback->user_to)
            ->avg('professionalism');

        // Communication Ratings
        $comm_rating = Feedback::where('user_to', $feedback->user_to)
        ->avg('communication');

        // Payment Ratings
        $pay_rating = Feedback::where('user_to', $feedback->user_to)
        ->avg('payment');

        // Clarity Specification Ratings
        $clarity_rating = Feedback::where('user_to', $feedback->user_to)
        ->avg('clarity_spec');

        // Employment Ratings
        $emp_rating = Feedback::where('user_to', $feedback->user_to)
        ->avg('emp');

        // On Time Rating
        $actual_on_time = Feedback::where('user_to', $feedback->user_to)->where('on_time', 1)->count();
        $total_on_time = Feedback::where('user_to', $feedback->user_to)->count();
        
        // On Budget Rating
        $actual_on_budget = Feedback::where('user_to', $feedback->user_to)->where('on_budget', 1)->count();
        $total_on_budget = Feedback::where('user_to', $feedback->user_to)->count();

        // Actual Results
        $rating = number_format(($prof_rating+$comm_rating+$pay_rating+$clarity_rating+$emp_rating)/5*1, 2, '.', '');
        $on_time = number_format($actual_on_time/$total_on_time*100, 2, '.', '');
        $on_budget = number_format($actual_on_budget/$total_on_budget*100, 2, '.', '');
        // Update User
        User::find($feedback->user_to)->update([
            'rating' => $rating,
            'on_time' => $on_time,
            'on_budget' => $on_budget,
        ]);
    }

    /**
     * Handle the Feedback "updated" event.
     *
     * @param  \App\Models\Feedback  $feedback
     * @return void
     */
    public function updated(Feedback $feedback)
    {
        //
    }

    /**
     * Handle the Feedback "deleted" event.
     *
     * @param  \App\Models\Feedback  $feedback
     * @return void
     */
    public function deleted(Feedback $feedback)
    {
        //
    }

    /**
     * Handle the Feedback "restored" event.
     *
     * @param  \App\Models\Feedback  $feedback
     * @return void
     */
    public function restored(Feedback $feedback)
    {
        //
    }

    /**
     * Handle the Feedback "force deleted" event.
     *
     * @param  \App\Models\Feedback  $feedback
     * @return void
     */
    public function forceDeleted(Feedback $feedback)
    {
        //
    }
}
