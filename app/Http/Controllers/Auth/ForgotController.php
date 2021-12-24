<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\ForgotMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class ForgotController extends Controller
{
    public function index()
    {
        return view('auth.forgot');
    }

    public function email(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        $chkMail = User::where('email', $request->email)->first();

        if(!$chkMail){
            return redirect()->back()->with('error', 'This Email not exist!');
        }
        Mail::to($request->email)->send(new ForgotMail($request->email));
        return redirect()->back()->with('message', 'Please check your email account!');
    }

    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if(User::where('email', $request->email)->update(['password' => Hash::make($request->password)])){
            return redirect()->route('login')->with('message', 'Your Password changed Successfully!');
        }
    }
}
