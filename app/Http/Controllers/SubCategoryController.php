<?php

namespace App\Http\Controllers;

use App\Models\SubCategory;
use Illuminate\Http\Request;

class SubCategoryController extends Controller
{
    public function index()
    {
        return SubCategory::all();
    }

    public function show($id)
    {
        return SubCategory::where('cate_id', $id)->get();
    }
}
