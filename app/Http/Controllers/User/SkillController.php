<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Skill;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SkillController extends Controller
{
    public function index(Request $request)
    {
        // $skill = $request->keyword;
        // if(!$skill){
            return Skill::all();
        // }
        // $result = DB::table('skills')->where('title','LIKE','%'.$skill.'%')
        //               ->get();
        // return response()->json([$result]);
    }
    
    function show($id)
    {
        return Skill::find($id);
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'keywords' => 'required',
        ]);
        return  $request->keywords;
    }
}
