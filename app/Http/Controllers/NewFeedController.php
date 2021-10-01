<?php

namespace App\Http\Controllers;

use App\Models\NewFeed;
use Illuminate\Http\Request;

class NewFeedController extends Controller
{
    public static function store($user_id, $message)
    {
        NewFeed::create([
            'user_id' => $user_id,
            'message' => $message
        ]);
    }
}
