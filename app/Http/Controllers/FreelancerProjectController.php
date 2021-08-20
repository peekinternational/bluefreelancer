<?php

namespace App\Http\Controllers;

use App\Models\Bid;
use App\Models\Project;
use Illuminate\Http\Request;

class FreelancerProjectController extends Controller
{
    public function index()
    {
        $openProjects = Bid::where('status','<',3)->where('user_id', auth()->id())->with('project')->orderByDesc('created_at')->paginate(5);
        $workProjects = Bid::where('status', 3)
            ->where('user_id', auth()->id())
            ->with('project', function ($query) {
                $query->where('status', '=', '2');
            })
            ->with('milestones')
            ->orderByDesc('created_at')
            ->paginate(5);

        // dd($workProjects);
        return view('project.my-project.freelancer', [
            'openProjects' => $openProjects,
            'workProjects' => $workProjects,
        ]);
    }
}
