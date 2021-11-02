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
    public function openProject(Request $request)
    {
        $limit = $request->limit ?? 10;
        $filter = $request->filter;
        if ($request->filter) {
            $openProjects = Bid::where('status', '<', 3)
                ->where('user_id', auth()->id())
                ->whereIn('project_id', function ($query) use ($filter) {
                    $query->select('project_id')
                        ->from('projects')
                        ->where('title', 'like', '%' . $filter . '%');
                })->with('project')->orderByDesc('created_at')->simplePaginate($limit);
        } else {
            $openProjects = Bid::where('status', '<', 3)
                ->where('user_id', auth()->id())
                ->with('project')
                ->orderByDesc('created_at')
                ->simplePaginate($limit);
        }
        // dd($openProjects);

        return view('project.my-project.freelancer.open-project', [
            'openProjects' => $openProjects,

        ]);
    }
    public function workProject(Request $request)
    {
        $limit = $request->limit ?? 10;
        $filter = $request->filter;
        if ($request->filter) {
            $workProjects = Bid::where('status', 3)
                ->where('user_id', auth()->id())
                ->whereIn('project_id', function ($query) use ($filter) {
                    $query->select('project_id')
                        ->from('projects')
                        ->where('title', 'like', '%' . $filter . '%');
                })
                ->with('project', function ($query) {
                    $query->where('status', '=', '2');
                })
                ->with('milestones')
                ->orderByDesc('created_at')
                ->simplePaginate($limit);
        } else {
            $workProjects = Bid::where('status', 3)
                ->where('user_id', auth()->id())
                ->with('milestones')
                ->orderByDesc('created_at')
                ->simplePaginate($limit);
        }
        return view('project.my-project.freelancer.work-project', [
            'workProjects' => $workProjects,
        ]);
    }
    public function pastProject(Request $request)
    {
        $limit = $request->limit ?? 10;
        $filter = $request->filter;
        if ($request->filter) {
            $pastProjects = Bid::where('status', 4)
                ->where('user_id', auth()->id())
                ->whereIn('project_id', function ($query) use ($filter) {
                    $query->select('project_id')
                        ->from('projects')
                        ->where('title', 'like', '%' . $filter . '%');
                })
                ->with('project', function ($query) {
                    $query->where('status', '=', '3');
                })
                ->orderByDesc('created_at')
                ->simplePaginate($limit);
        } else {
            $pastProjects = Bid::where('status', 4)
                ->where('user_id', auth()->id())
                ->with('project', function ($query) {
                    $query->where('status', '=', '3');
                })
                ->orderByDesc('created_at')
                ->simplePaginate($limit);
        }
        return view('project.my-project.freelancer.past-project', [
            'pastProjects' => $pastProjects,
        ]);
    }
    public function activeContest(Request $request)
    {
        $limit = $request->limit ?? 10;
        $filter = $request->filter;
        if ($request->filter) {
            $activeContest = ContestEntry::where('status', 1)
                ->where('user_id', auth()->id())
                ->whereIn('contest_id', function ($query) use ($filter) {
                    $query->select('contest_id')
                        ->from('contests')
                        ->where('title', 'like', '%' . $filter . '%');
                })
                ->with(['contest', 'ContestEntries'])
                ->orderByDesc('created_at')
                ->simplePaginate($limit);
        } else {
            $activeContest = ContestEntry::where('status', 1)
                ->where('user_id', auth()->id())
                ->with(['contest', 'ContestEntries'])
                ->orderByDesc('created_at')
                ->simplePaginate($limit);
        }
        return view('project.my-project.freelancer.active-contest', [
            'activeContest' => $activeContest,
        ]);
    }
    public function pastContest(Request $request)
    {
        $limit = $request->limit ?? 10;
        $filter = $request->filter;
        if ($request->filter) {
            $pastContest = ContestEntry::where('status', 2)
                ->whereIn('contest_id', function ($query) use ($filter) {
                    $query->select('contest_id')
                        ->from('contests')
                        ->where('title', 'like', '%' . $filter . '%');
                })
                ->with(['contest', 'ContestEntries', 'user'])
                ->orderByDesc('created_at')
                ->simplePaginate($limit);
        } else {
            $pastContest = ContestEntry::where('status', 2)
                ->with(['contest', 'ContestEntries', 'user'])
                ->orderByDesc('created_at')
                ->simplePaginate($limit);
        }
        return view('project.my-project.freelancer.past-contest', [
            'pastContest' => $pastContest,
        ]);
    }
}
