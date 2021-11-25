<?php

namespace App\Http\Controllers;

use App\Models\Bid;
use App\Models\Project;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProjectController extends Controller
{
    public function index(Request $request)
    {
        $projects = new Project();

        if ($request->has('search_project_by_title') || $request->has('search_project_by_skills')) {
            $projects = $projects->where('title', 'like', '%' . $request->search_project_by_title . '%')->where('skills', 'like', '%' . $request->search_project_by_skills . '%')
                ->orderByDesc('created_at')->paginate(5);
        }elseif($request->has('category')){
            $projects = $projects->where('main_category', $request->category)
                ->orderByDesc('created_at')->paginate(5);
        } else {
            $projects = $projects->orderByDesc('created_at')->paginate(5);
        }
        return view('project.project-listing', [
            'projects' => $projects
        ]);
    }
    public function store(Request $request)
    {
        //    dd($request);
        $request->validate([
            'title' => 'required',
            'project_description' => 'required',
            'project_skills' => 'required',
            'main_category' => 'required',
            'sub_category' => 'required',
            'currency' => 'required',
        ]);
        if ($request->hasFile("image")) {
            $this->validate($request, [
                'image' => 'required|mimes:jpeg,jpg,png,doc,docx,pdf|max:1024',
            ]);
            $request->image = $this->linkImage($request->image);
        }
        $project = Project::create([
            'project_id' => time() . Str::random(9),
            'title' => $request->title,
            'description' => $request->project_description,
            'skills' => $request->project_skills,
            'image' => $request->image,
            'location' => $request->location,
            'main_category' => $request->main_category,
            'sub_category' => $request->sub_category,
            'rate_status' => $request->rate_status,
            'currency' => $request->currency,
            'fixed_rate' => $request->fixed_rate,
            'hourly_rate' => $request->hourly_rate,
            'min_budget' => $request->min_budget,
            'max_budget' => $request->max_budget,
            'status' => 1,
            'user_id' => auth()->id(),
        ]);

        if ($project) {
            return redirect()->route('project.manage', $project->project_id)->with('message', 'Project Posted Successfully!');
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'project_title' => 'required',
            'project_description' => 'required',
        ]);

        $project = Project::where('project_id', $id)->update([
            'title' => $request->project_title,
            'description' => $request->project_description,
        ]);

        if ($project) {
            return redirect()->route('project.manage', $id)->with('message', 'Project Details Updated Successfully!');
        }
    }
    public function show($id)
    {
        $project = Project::where('project_id', $id)->with('user')->first();
        $bidsOnProject = Bid::where('project_id', $id)->with(['user', 'milestones'])->get();
        $bidsSeleProjCount = Bid::where('project_id', $id)->where('status', '>', 1)->get();
        $bidsOnProjCount = Bid::where('project_id', $id)->where('status', 1)->with('user')->count();
        // dd($bidsSeleProjCount);
        return view('project.project-details', [
            'project' => $project,
            'bidsOnProject' => $bidsOnProject,
            'bidsOnProjCount' => $bidsOnProjCount,
            'bidsSeleProjCount' => $bidsSeleProjCount,
        ]);
    }

    // =================================
    // ------- Common Functions --------
    // =================================
    public function unlinkImage($name)
    {
        $filePath = public_path() . '/uploads/project/images/' . $name;
        if (file_exists($filePath)) {
            @unlink($filePath);
        }
    }
    public function linkImage($image)
    {
        $imageName = time() . '.' . $image->extension();
        $image->move(public_path('uploads/project/images/'), $imageName);
        return $imageName;
    }
}
