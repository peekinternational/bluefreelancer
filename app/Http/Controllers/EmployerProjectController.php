<?php

namespace App\Http\Controllers;

use App\Models\Bid;
use App\Models\Contest;
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
                $query->where('status', '=', '3');
            })
            ->with('milestones')
            ->orderByDesc('created_at')
            ->paginate(5);
        $openContests = Contest::where('status', 1)->where('user_id', auth()->id())->with('contestEntries')->orderByDesc('created_at')->paginate(5);
        $awardedContests = Contest::where('status', 2)->where('user_id', auth()->id())->with('contestEntryCompleted')->orderByDesc('created_at')->paginate(5);

        // dd($openContests);
        return view('project.my-project.employer', [
            'openProjects' => $openProjects,
            'workProjects' => $workProjects,
            'openContests' => $openContests,
            'awardedContests' => $awardedContests,
        ]);
    }

    public function openProject()
    {
        $openProjects = Project::where('status', 1)->where('user_id', auth()->id())->orderByDesc('created_at')->paginate(5);
        return view('project.my-project.employer.open-project', [
            'openProjects' => $openProjects,
        ]);
    }

    public function workProject()
    {
        $workProjects = Project::where('status', 2)
            ->where('user_id', auth()->id())
            ->with('bid', function ($query) {
                $query->where('status', '=', '3');
            })
            ->with('milestones')
            ->orderByDesc('created_at')
            ->paginate(5);

        return view('project.my-project.employer.work-project', [
            'workProjects' => $workProjects,
        ]);
    }

    public function pastProject()
    {
        return view('project.my-project.employer.past-project');
    }

    public function openContest()
    {
        $openContests = Contest::where('status', 1)->where('user_id', auth()->id())->with('contestEntries')->orderByDesc('created_at')->paginate(5);

        return view('project.my-project.employer.open-contest', [
            'openContests' => $openContests,
        ]);
    }

    public function awardedContest()
    {
        $awardedContests = Contest::where('status', 2)->where('user_id', auth()->id())->with('contestEntryCompleted')->orderByDesc('created_at')->paginate(5);

        return view('project.my-project.employer.awarded-contest', [
            'awardedContests' => $awardedContests,
        ]);
    }
}
