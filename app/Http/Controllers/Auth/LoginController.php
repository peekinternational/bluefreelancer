<?php

namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
class LoginController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);
        
        if(!auth()->attempt($request->only('username', 'password'), $request->remember)){
            return back()->with('status', 'Invalid login details');
        }

        return redirect()->intended('dashboard')->with('message', 'Welcome Back!');
    }
}
