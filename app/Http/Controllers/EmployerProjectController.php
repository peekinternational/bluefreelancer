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

    public function openProject(Request $request)
    {
        $projects = new Project();
        $limit = $request->limit ?? 10;
        // dd($limit); 
        if ($request->filter) {
            $openProjects = $projects->where('status', 1)->where('user_id', auth()->id())->where('title', 'like', '%' . $request->filter . '%')->orderByDesc('created_at')->simplePaginate($limit);
        } else {
            $openProjects = $projects->where('status', 1)->where('user_id', auth()->id())->orderByDesc('created_at')->simplePaginate($limit);
        }
        // return $openProjects->withPath('project/my-project/employer/open-projects?limit=2');
        // dd($openProjects);
        return view('project.my-project.employer.open-project', [
            'openProjects' => $openProjects,
        ]);
    }

    public function workProject(Request $request)
    {
        $projects = new Project();
        $limit = $request->limit ?? 10;
        if ($request->filter) {
            $workProjects = $projects->where('status', 2)
                ->where('user_id', auth()->id())
                ->where('title', 'like', '%' . $request->filter . '%')
                ->with('bid', function ($query) {
                    $query->where('status', '=', '3');
                })
                ->with('milestones')
                ->orderByDesc('created_at')
                ->simplePaginate($limit);
        } else {
            $workProjects = $projects->where('status', 2)
                ->where('user_id', auth()->id())
                ->with('bid', function ($query) {
                    $query->where('status', '=', '3');
                })
                ->with('milestones')
                ->orderByDesc('created_at')
                ->simplePaginate($limit);
        }


        return view('project.my-project.employer.work-project', [
            'workProjects' => $workProjects,
        ]);
    }

    public function pastProject()
    {

        return view('project.my-project.employer.past-project');
    }

    public function openContest(Request $request)
    {
        $contests = new Contest();
        $limit = $request->limit ?? 10;
        if ($request->filter) {
            $openContests = $contests->where('status', 1)->where('user_id', auth()->id())->where('title', 'like', '%' . $request->filter . '%')->with('contestEntries')->orderByDesc('created_at')->simplePaginate($limit);
        } else {
            $openContests = $contests->where('status', 1)->where('user_id', auth()->id())->with('contestEntries')->orderByDesc('created_at')->simplePaginate($limit);
        }

        return view('project.my-project.employer.open-contest', [
            'openContests' => $openContests,
        ]);
    }

    public function awardedContest(Request $request)
    {
        $contests = new Contest();
        $limit = $request->limit ?? 10;
        if ($request->filter) {
            $awardedContests = $contests->where('status', 2)->where('user_id', auth()->id())->where('title', 'like', '%' . $request->filter . '%')->with('contestEntryCompleted')->orderByDesc('created_at')->simplePaginate($limit);
        } else {
            $awardedContests = $contests->where('status', 2)->where('user_id', auth()->id())->with('contestEntryCompleted')->orderByDesc('created_at')->simplePaginate($limit);
        }
        return view('project.my-project.employer.awarded-contest', [
            'awardedContests' => $awardedContests,
        ]);
    }
}
