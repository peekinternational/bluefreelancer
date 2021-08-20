<?php

namespace App\Http\Controllers;

use App\Models\Showcase;
use Illuminate\Http\Request;

class ShowcaseController extends Controller
{
    public function index()
    {
    }
    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|mimes:jpeg,jpg,png|max:1024',
            'title' => 'required',
            'description' => 'required',
            'amt' => 'required',
            'currency' => 'required',
            'cate' => 'required',
        ]);
        $request->image = $this->linkImage($request->image);
        $showcase = Showcase::create([
            'title' => $request->title,
            'description' => $request->description,
            'img' => $request->image,
            'amt' => $request->amt,
            'currency' => $request->currency,
            'cate' => $request->cate,
            'status' => 1,
            'user_id' => auth()->id(),
        ]);

        if ($showcase) {
            return redirect()->route('showcase.create')->with('message', 'Showcase Has been Register Successfully!, Kindly Wait for the Approval.');
        }
    }
    public function show($id)
    {
        # code...
    }
    // =================================
    // ------- Common Functions --------
    // =================================
    public function unlinkImage($name)
    {
        $filePath = public_path() . '/uploads/showcases/' . $name;
        if (file_exists($filePath)) {
            @unlink($filePath);
        }
    }
    public function linkImage($image)
    {
        $imageName = time() . '.' . $image->extension();
        $image->move(public_path('uploads/showcases/'), $imageName);
        return $imageName;
    }
}
