<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Portfolio;
use Illuminate\Http\Request;

class PortfolioController extends Controller
{
    public function show($id)
    {
        return Portfolio::find($id);
    }
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'skills' => 'required',
            'image' => 'required',
        ]);
        if ($request->hasFile("image")) {
            $this->validate($request, [
                'image' => 'mimes:jpeg,jpg,png|max:1024',
            ]);
            $request->image = $this->linkImage($request->image);
        }
        $portfolio = Portfolio::create([
            'title' => $request->title,
            'description' => $request->description,
            'skills' => $request->skills,
            'image' => $request->image,
            'user_id' => auth()->id(),
        ]);

        if ($portfolio) {
            return response()->json([
                'message' => 'Successfully Added!',
            ]);
        }
    }
    public function update(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'skills' => 'required',
        ]);
        if ($request->hasFile("image")) {
            $this->validate($request, [
                'image' => 'mimes:jpeg,jpg,png|max:1024',
            ]);
            $portfolio = Portfolio::find($request->id);
            if ($portfolio) {
                $this->unlinkImage($portfolio->image);
            }
            $request->image = $this->linkImage($request->image);
            Portfolio::find($portfolio->id)->update(['image' => $request->image]);
        }
        Portfolio::where('user_id', auth()->id())
            ->where('id', $request->id)
            ->update([
                'title' => $request->title,
                'description' => $request->description,
                'skills' => $request->skills,
            ]);
        return response()->json([
            'message' => 'Successfully Updated!',
        ]);
    }
    // =================================
    // ------- Common Functions ------
    // =================================
    public function unlinkImage($name)
    {
        $filePath = public_path() . '/uploads/users/' . auth()->id() . '/images/portfolio/' . $name;
        if (file_exists($filePath)) {
            @unlink($filePath);
        }
    }
    public function linkImage($image)
    {
        $imageName = time() . '.' . $image->extension();
        $image->move(public_path('uploads/users/' . auth()->id() . '/images/portfolio/'), $imageName);
        return $imageName;
    }
}
