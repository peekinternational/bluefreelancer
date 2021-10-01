<?php

namespace App\Http\Controllers;

use App\Models\NewFeed;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $newsFeed = NewFeed::where('user_id', auth()->id())->simplePaginate(5);
        return  view('dashboard', [
            'newsFeed' => $newsFeed
        ]);
    }
}
