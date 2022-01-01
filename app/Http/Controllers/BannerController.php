<?php

namespace App\Http\Controllers;

use Intervention\Image\Facades\Image;
use App\Models\Banner;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('banner.index', [
            'banners' => Banner::all(),
            'deleted_banners' => Banner::onlyTrashed()->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('banner.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'banner_message' => 'required',
            'banner_photo' => 'required|mimes:png,jpg',
        ]);
        if ($request->hasFile('banner_photo')) {
            $banner_name = Str::random('12') . auth()->id() . '.' . $request->file('banner_photo')->getClientOriginalExtension();
            Image::make($request->file('banner_photo'))->save(base_path("public/uploads/banner/$banner_name"));
        }
        Banner::insert([
            'banner_message' => $request->banner_message,
            'offer_message' => $request->offer_message,
            'banner_photo' => $banner_name,
            'created_by' => auth()->id(),
            'created_at' => Carbon::now()
        ]);
        return redirect('/banner')->with('success', 'Banner added successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function show(Banner $banner)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function edit(Banner $banner)
    {
        return view('banner.edit', compact('banner'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Banner $banner)
    {
        $request->validate([
            'banner_message' => 'required',
            'banner_photo' => 'mimes:png,jpg',
        ]);

        if ($request->hasFile('banner_photo')) {
            unlink(base_path("public/uploads/banner/$banner->banner_photo"));
            $banner_name = Str::random('12') . auth()->id() . '.' . $request->file('banner_photo')->getClientOriginalExtension();
            Image::make($request->file('banner_photo'))->save(base_path("public/uploads/banner/$banner_name"));
            $banner->banner_photo  = $banner_name;
            $banner->save();
        }
        $banner->banner_message = $request->banner_message;
        $banner->offer_message = $request->offer_message;
        $banner->save();

        return redirect('/banner')->with('success', 'Banner added successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function destroy(Banner  $banner)
    {
        $banner->delete();
        return back()->with('success', 'Banner deleted successfully');
    }
    // soft delete
    public function delete($id)
    {
        $banner =  Banner::onlyTrashed()->where('id', $id)->first();
        unlink(base_path("public/uploads/banner/$banner->banner_photo"));
        Banner::onlyTrashed()->where('id', $id)->forceDelete();
        return back()->with('success', 'Banner deleted successfully');
    }
    // Restore
    public function restore($id)
    {
        Banner::onlyTrashed()->where('id', $id)->restore();
        Banner::where('id', $id)->update([
            'updated_by' => auth()->id()
        ]);
        return back()->with('success', 'Banner restore successfully');
    }
}
