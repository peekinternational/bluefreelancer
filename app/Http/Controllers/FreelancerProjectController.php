<?php

namespace App\Http\Controllers;

use App\Models\Bid;
use App\Models\ContestEntry;
use App\Models\Project;
use Illuminate\Http\Request;

class FreelancerProjectController extends Controller
{
    public function index()
    {
        $openProjects = Bid::where('status', '<', 3)->where('user_id', auth()->id())->with('project')->orderByDesc('created_at')->paginate(5);
        $workProjects = Bid::where('status', 3)
            ->where('user_id', auth()->id())
            ->with('project', function ($query) {
                $query->where('status', '=', '2');
            })
            ->with('milestones')
            ->orderByDesc('created_at')
            ->simplePaginate(5);
        $activeContest = ContestEntry::where('status', 1)->where('user_id', auth()->id())->with(['contest', 'ContestEntries'])->orderByDesc('created_at')->paginate(5);
        $pastContest = ContestEntry::where('status', 2)->with(['contest', 'ContestEntries', 'user'])->orderByDesc('created_at')->paginate(5);
        return view('project.my-project.freelancer', [
            'openProjects' => $openProjects,
            'workProjects' => $workProjects,
            'activeContest' => $activeContest,
            'pastContest' => $pastContest,
        ]);
    }
    public function openProject()
    {
        $openProjects = Bid::where('status', '<', 3)->where('user_id', auth()->id())->with('project')->orderByDesc('created_at')->paginate(5);

        return view('project.my-project.freelancer.open-project', [
            'openProjects' => $openProjects,

        ]);
    }
    public function workProject()
    {
        $workProjects = Bid::where('status', 3)
            ->where('user_id', auth()->id())
            ->with('project', function ($query) {
                $query->where('status', '=', '2');
            })
            ->with('milestones')
            ->orderByDesc('created_at')
            ->simplePaginate(5);

        return view('project.my-project.freelancer.work-project', [
            'workProjects' => $workProjects,
        ]);
    }
    public function pastProject()
    {
        return view('project.my-project.freelancer.past-project');
    }
    public function activeContest()
    {
        $activeContest = ContestEntry::where('status', 1)->where('user_id', auth()->id())->with(['contest', 'ContestEntries'])->orderByDesc('created_at')->paginate(5);

        return view('project.my-project.freelancer.active-contest', [
            'activeContest' => $activeContest,
        ]);
    }
    public function pastContest()
    {
        $pastContest = ContestEntry::where('status', 2)->with(['contest', 'ContestEntries', 'user'])->orderByDesc('created_at')->paginate(5);

        return view('project.my-project.freelancer.past-contest', [
            'pastContest' => $pastContest,
        ]);
    }
}
