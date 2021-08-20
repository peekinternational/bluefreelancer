<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Experience;
use Illuminate\Http\Request;
use App\Models\User;

class ProfileController extends Controller
{
    public function hourlyRate(Request $request)
    {
        $request->validate([
            'hourly_rate' => 'required',
        ]);

        if (User::find(auth()->id())->update(['hourly_rate' => $request->hourly_rate])) {
            return response()->json([
                'message' => 'Successfully Changed',
            ]);
        }
    }

    public function coverImage(Request $request)
    {
        // image process & validation...
        if ($request->hasFile("cover_img")) {
            $this->validate($request, [
                'cover_img' => 'required|mimes:jpeg,jpg,png|max:2048',
            ]);
            if (auth()->user()->cover_img) {
                $this->unlinkImage(auth()->user()->cover_img);
            }
            $request->cover_img = $this->linkImage($request->cover_img);
            $user = User::find(auth()->id());
            $user->cover_img = $request->cover_img;
            $user->save();
            return redirect('/profile?edit_profile=1')->with('message', 'Profile Cover Image Uploaded Successfully!');
        }
    }

    public function profileImage(Request $request)
    {
        // image process & validation...
        if ($request->hasFile("img")) {
            $this->validate($request, [
                'img' => 'required|mimes:jpeg,jpg,png|max:1024',
            ]);
            if (auth()->user()->img) {
                $this->unlinkImage(auth()->user()->img);
            }
            $request->img = $this->linkImage($request->img);
            $user = User::find(auth()->id());
            $user->img = $request->img;
            $user->save();
            return redirect('/profile?edit_profile=1')->with('message', 'Profile Image Uploaded Successfully!');
        }
    }

    public function professionHeadline(Request $request)
    {
        $request->validate([
            'prof_headline' => 'required',
        ]);
        if (User::find(auth()->id())->update(['prof_headline' => $request->prof_headline])) {
            return response()->json([
                'message' => 'Successfully Changed!',
            ]);
        }
    }

    public function description(Request $request)
    {
        $request->validate([
            'description' => 'required',
        ]);
        if (User::find(auth()->id())->update(['description' => $request->description])) {
            return response()->json([
                'message' => 'Successfully Changed!',
            ]);
        }
    }
    public function experienceList(User $user)
    {
        $experiences = $user->experiences();
        return view('user.profile', [
            'experiences' => $experiences,
        ]);
    }

    public function skillStore(Request $request)
    {
        $request->validate([
            'keywords' => 'required',
        ]);
        if (User::find(auth()->id())->update(['skills' => $request->keywords])) {
            return response()->json([
                'message' => 'Successfully Changed!',
            ]);
        }
        // return  $request->keywords;
    }

    public function profCertificationStore(Request $request)
    {
        $request->validate([
            'keywords' => 'required',
        ]);
        if (User::find(auth()->id())->update(['certs' => $request->keywords])) {
            return response()->json([
                'message' => 'Successfully Changed!',
            ]);
        }
        // return  $request->keywords;
    }
    // =================================
    // ------- Common Functions ------
    // =================================
    public function unlinkImage($name)
    {
        $filePath = public_path() . '/uploads/users/' . auth()->id() . '/images/' . $name;
        if (file_exists($filePath)) {
            @unlink($filePath);
        }
    }
    public function linkImage($image)
    {
        $imageName = time() . '.' . $image->extension();
        $image->move(public_path('uploads/users/' . auth()->id() . '/images/'), $imageName);
        return $imageName;
    }
}
