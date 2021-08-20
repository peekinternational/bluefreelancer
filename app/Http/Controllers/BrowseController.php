<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\SubCategory;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class BrowseController extends Controller
{
    public function directory(Request $request)
    {
        $freelancers = new User();
        $freelancers = $freelancers->where('usertype', 3);

        if ($request->has('search_freelancer_by_name') || $request->has('search_freelancer_skills') || $request->has('search_freelancer_by_country')) {
            $freelancers = $freelancers
            ->where('username', 'like', '%' . $request->search_freelancer_by_name . '%')
            ->where('skills', 'like', '%' . $request->search_freelancer_skills . '%')
            ->where('country', 'like', '%' . $request->search_freelancer_by_country . '%')
            ->orderByDesc('created_at')->paginate(10);
        } else {
            $freelancers = $freelancers->orderByDesc('created_at')->paginate(10);
        }
        return view('browse.directory', [
            'freelancers' => $freelancers,
        ]);
    }

    public function category(Request $request)
    {
        if($request->search_category_by_title){
            $categories = Category::where('title', 'like', '%' . $request->search_category_by_title . '%')->get();
        }else{
            $categories = Category::all();
        }
        return view('browse.category', [
            'categories' => $categories,
        ]);
    }

    public function categoryDetails(Request $request, $id)
    {
        $id = Crypt::decryptString($id);

        if($request->search_sub_category_by_title){
            $sub_categories = SubCategory::where('cate_id', $id)->where('title', 'like', '%' . $request->search_sub_category_by_title . '%')->get();
        }else{
            $sub_categories = SubCategory::where('cate_id', $id)->get();
        }
        return view('browse.category-details', [
            'sub_categories' => $sub_categories,
        ]);
    }
}
