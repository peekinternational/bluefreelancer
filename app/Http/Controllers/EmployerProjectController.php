<?php

namespace App\Http\Controllers;

use App\Models\Bid;
use App\Models\Project;
use Illuminate\Http\Request;

class EmployerProjectController extends Controller
{
    public function index()
    {
        $openProjects = Project::where('status', 1)->where('user_id', auth()->id())->orderByDesc('created_at')->paginate(5);
        $workProjects = Project::where('status', 2)
                                ->where('user_id', auth()->id())
                                ->with('bid', function ($query) {
                                    $query->where('status','=','3');
                                })
                                ->with('milestones')
                                ->orderByDesc('created_at')
                                ->paginate(5);
                                
        // dd($openProjects);
        return view('project.my-project.employer', [
            'openProjects' => $openProjects,
            'workProjects' => $workProjects,
        ]);
    }
}
