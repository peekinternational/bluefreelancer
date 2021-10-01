<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Rules\MatchOldPassword;

class SettingController extends Controller
{
    public function profile(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'companyname' => 'required|max:255',
            'country' => 'required|max:255',
        ]);
        $user = User::find(auth()->id());
        $user->name = $request->name;
        $user->companyname = $request->companyname;
        $user->address = $request->address;
        $user->city = $request->city;
        $user->zipcode = $request->zipcode;
        $user->country = $request->country;
        $user->state = $request->state;
        $user->timezone = $request->timezone;
        $user->location = $request->location;
        $user->save();

        return redirect()->route('/setting/profile')->with('message', 'Profile Update Successfully!');
    }
    public function email(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:users,email',
        ]);
        if (User::find(auth()->id())->update(['email' => $request->email])) {
            return redirect()->route('/setting/notification')->with('message', 'Email Changed Successfully!');
        }
    }
    public function passwordChange(Request $request)
    {
        $request->validate([
            'current_password' => ['required', new MatchOldPassword],
            'new_password' => 'required',
            'password_confirmation' => 'same:new_password',
        ]);
        if (User::find(auth()->id())->update(['password' => Hash::make($request->new_password)])) {
            return redirect()->route('/setting/password')->with('message', 'Password Changed Successfully!');
        }
    }
    public function account(Request $request)
    {
        $request->validate([
            'usertype' => 'required',
        ]);

        $user = User::find(auth()->id());
        $user->usertype = $request->usertype;
        $user->save();

        return redirect()->route('/setting/account')->with('message', 'Account Changed Successfully!');
    }
    public function notifyAllFreelancers()
    {
        if (auth()->user()->notify_all_freelancers == 1) {
            $user = User::find(auth()->id())->update(['notify_all_freelancers' => 0]);
        } else {
            $user = User::find(auth()->id())->update(['notify_all_freelancers' => 1]);
        }
        if ($user) {
            return response()->json([
                'status' => true,
            ]);
        }
    }
    public function notifyAllProjects()
    {
        if (auth()->user()->notify_all_projects == 1) {
            $user = User::find(auth()->id())->update(['notify_all_projects' => 0]);
        } else {
            $user = User::find(auth()->id())->update(['notify_all_projects' => 1]);
        }
        if ($user) {
            return response()->json([
                'status' => true,
            ]);
        }
    }
}
