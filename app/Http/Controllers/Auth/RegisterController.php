<?php

namespace App\Http\Controllers\Auth;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
class RegisterController extends Controller
{    
    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required|max:255',
            'companyname' => 'required|max:255',
            'business_reg_num' => 'required|max:255|unique:users,business_reg_num',
            'username' => 'required|max:255|unique:users,username',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|confirmed',
            'usertype' => 'required'
        ]);

        User::create([
            'name' => $request->name,
            'username' => $request->username,
            'companyname' => $request->companyname,
            'business_reg_num' => $request->business_reg_num,
            'usertype' => $request->usertype,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'bids' => 300,
        ]);

        auth()->attempt($request->only('username','email', 'password'));

        return redirect()->route('dashboard')->with('message', 'Congratulations you are now part of Blue Freelancer!');
    }
}
