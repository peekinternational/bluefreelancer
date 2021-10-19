<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\App;

use Illuminate\Http\Request;

class LangController extends Controller
{
    public function set($lang)
    {
        App::setLocale($lang);
        session()->put('lang', $lang);
        return redirect()->back();
    }
}
