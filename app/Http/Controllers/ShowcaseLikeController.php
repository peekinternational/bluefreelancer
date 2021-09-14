<?php

namespace App\Http\Controllers;

use App\Models\ShowcaseLike;
use Illuminate\Http\Request;

class ShowcaseLikeController extends Controller
{
    public function store($id)
    {
        $showcaseLike = ShowcaseLike::create([
            'showcase_id' => $id,
            'user_id' => auth()->id(),
        ]);
        if ($showcaseLike) {
            return true;
        }
    }
    public function destory($id)
    {
        $showcaseLike = ShowcaseLike::where([
            'showcase_id' => $id,
            'user_id' => auth()->id(),
        ])->delete();
        if ($showcaseLike) {
            return true;
        }
    }
}
