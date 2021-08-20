<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\ProfCertification;
use Illuminate\Http\Request;

class ProfCertificationController extends Controller
{
    public function index(Request $request)
    {
        // $skill = $request->keyword;
        // if(!$skill){
        return ProfCertification::all();
        // }
        // $result = DB::table('skills')->where('title','LIKE','%'.$skill.'%')
        //               ->get();
        // return response()->json([$result]);
    }
}
