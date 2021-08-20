<?php

namespace App\Http\Controllers\Project;

use App\Http\Controllers\Controller;
use App\Models\Bid;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectManageController extends Controller
{
    public function index($id)
    {
        $proposals = Bid::where('project_id', $id)->with(['user', 'milestones'])->get();
        $project = Project::where('project_id', $id)->first();
        return view('project.manage.index', [
            'proposals' => $proposals,
            'project' => $project,
        ]);
    }
}
