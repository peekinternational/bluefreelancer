<?php

namespace App\Http\Controllers;

use App\Models\Showcase;
use Illuminate\Http\Request;

class ShowcaseController extends Controller
{
    public function index(Request $request)
    {
        if ($request->category) {
            $showcases = Showcase::where('status', 2)->where('cate', 'like', '%' . $request->category . '%')->with(['showcaseLikes'])->orderBy('created_at')->paginate(20);
        } else {
            $showcases = Showcase::where('status', 2)->with(['showcaseLikes'])->orderBy('created_at')->paginate(20);
        }
        // dd($showcases);
        return  view('showcase.index', [
            'showcases' => $showcases
        ]);
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
            return redirect()->route('showcase.my-showcase')->with('message', 'Showcase Has been Register Successfully!, Kindly Wait for the Approval.');
        }
    }
    public function myShowcase(Request $request)
    {
        $regShowcases = Showcase::where('user_id', auth()->id())->where('status', 2)->with('showcaseLikes')->get();
        $approveShowcases = Showcase::where('user_id', auth()->id())->where('status', 1)->get();
        $rejectedShowcases = Showcase::where('user_id', auth()->id())->where('status', 3)->get();
        return view('showcase.my-showcase', [
            'regShowcases' => $regShowcases,
            'approveShowcases' => $approveShowcases,
            'rejectedShowcases' => $rejectedShowcases,
        ]);
    }
    public function show($id)
    {
        return Showcase::where('id', $id)->with(['user', 'showcaseLikes'])->first();
    }
    public function edit($id)
    {
        $showcase =  Showcase::where('id', $id)->first();
        return view('showcase.edit', [
            'showcase' => $showcase
        ]);
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'amt' => 'required',
            'currency' => 'required',
            'cate' => 'required',
        ]);
        if ($request->hasFile("image")) {
            $this->validate($request, [
                'image' => 'mimes:jpeg,jpg,png|max:1024',
            ]);
            $showcase = Showcase::find($id);
            if ($showcase) {
                $this->unlinkImage($showcase->image);
            }
            $request->image = $this->linkImage($request->image);
            Showcase::find($showcase->id)->update(['img' => $request->image]);
        }
        $showcaseUpdate = Showcase::where('id', $id)->update([
            'title' => $request->title,
            'description' => $request->description,
            'amt' => $request->amt,
            'currency' => $request->currency,
            'cate' => $request->cate,
        ]);
        if ($showcaseUpdate) {
            return redirect()->route('showcase.my-showcase')->with('message', 'Showcase Has been Updated Successfully!');
        }
    }

    public function destory($id)
    {
        if (Showcase::find($id)->delete()) {
            return redirect()->route('showcase.my-showcase')->with('message', 'Showcase Has been Deleted Successfully!');
        }
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
