<?php

namespace App\Observers;

use App\Models\Notification;
use App\Models\Project;
use App\Models\User;

class ProjectObserver
{
    /**
     * Handle the Project "created" event.
     *
     * @param  \App\Models\Project  $project
     * @return void
     */
    public function created(Project $project)
    {
        // dd($project);
        $user = User::where('id', $project->user_id)->first(['notify_all_freelancers', 'notify_all_projects']);
        // dd($user);
        if ($user->notify_all_freelancers == 1) {
            $freelancers = User::where('usertype', 3)->get('id');
            foreach ($freelancers as $key) {
                Notification::create([
                    'from' => $project->user_id,
                    'to' => $key->id,
                    'message' => 'Project Posted! "' . $project->title . '" if you wanna bid on this project check on Browse Project listing.',
                    'url' => '/project-details/'. $project->project_id
                ]);
            }
        }
        if ($user->notify_all_projects == 1) {
            $users = User::where('skills', 'like', '%' . $project->skills . '%')->get('id');
            foreach ($users as $key) {
                if ($key->id != auth()->id()) {
                    Notification::create([
                        'from' => $project->user_id,
                        'to' => $key->id,
                        'message' => 'Recently Project Posted which matches with your expertise!, "' . $project->title . '". If you wanna bid on this project check on Browse Project listing.',
                        'url' => '/project-details/'. $project->project_id
                    ]);
                }
            }
        }
    }

    /**
     * Handle the Project "updated" event.
     *
     * @param  \App\Models\Project  $project
     * @return void
     */
    public function updated(Project $project)
    {
        //
    }

    /**
     * Handle the Project "deleted" event.
     *
     * @param  \App\Models\Project  $project
     * @return void
     */
    public function deleted(Project $project)
    {
        //
    }

    /**
     * Handle the Project "restored" event.
     *
     * @param  \App\Models\Project  $project
     * @return void
     */
    public function restored(Project $project)
    {
        //
    }

    /**
     * Handle the Project "force deleted" event.
     *
     * @param  \App\Models\Project  $project
     * @return void
     */
    public function forceDeleted(Project $project)
    {
        //
    }
}
