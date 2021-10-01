<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use Illuminate\Http\Request;

class SupportController extends Controller
{
    public function index(Request $request)
    {
        return view('support.index');
    }

    public function show($category, Request $request)
    {
        if ($request->filter) {
            $faqs = Faq::where('category', $category)->where('title', 'like', '%' . $request->filter . '%')->get();
        } else {
            $faqs = Faq::where('category', $category)->get();
        }
        return view('support.show', [
            'faqs' => $faqs
        ]);
    }
}
