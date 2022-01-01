<?php

namespace App\Http\Controllers;

use App\Models\Feature;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class FeatureController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('feature.index', [
            'features' => Feature::all(),
            'deleted_features' => Feature::onlyTrashed()->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('feature.create');
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
            'feature_name' => 'required',
            'feature_message' => 'required',
            'feature_photo' => 'required|mimes:png,jpg,PNG,JPG'
        ]);
        $feature_photo = Str::random(8) . auth()->id() . "." . $request->file('feature_photo')->getClientOriginalExtension();
        Image::make($request->file('feature_photo'))->save(base_path("public/uploads/feature/$feature_photo"));
        Feature::insert([
            'feature_name' => $request->feature_name,
            'feature_message' => $request->feature_message,
            'feature_photo' => $feature_photo,
            'created_by' => auth()->id(),
            'created_at' => Carbon::now()
        ]);
        return redirect('feature')->with("success", "Feature  inserted successfully");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Feature  $feature
     * @return \Illuminate\Http\Response
     */
    public function show(Feature $feature)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Feature  $feature
     * @return \Illuminate\Http\Response
     */
    public function edit(Feature $feature)
    {
        return view('feature.edit', compact('feature'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Feature  $feature
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Feature $feature)
    {
        $request->validate([
            'feature_name' => 'required',
            'feature_message' => 'required',
        ]);
        if ($request->hasFile('feature_photo')) {
            $request->validate([
                'receipt' => 'mimes:png,jpg,PNG,JPG'
            ]);
            unlink(base_path("public/uploads/feature/$feature->feature_photo"));
            $feature_photo = Str::random(8) . auth()->id() . "." . $request->file('feature_photo')->getClientOriginalExtension();
            Image::make($request->file('feature_photo'))->save(base_path("public/uploads/feature/$feature_photo"));
            $feature->feature_photo = $feature_photo;
            $feature->save();
        }
        $feature->feature_name = $request->feature_name;
        $feature->feature_message = $request->feature_message;
        $feature->save();
        return redirect('feature')->with("success", "Feature  updated successfully");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Feature  $feature
     * @return \Illuminate\Http\Response
     */
    public function destroy(Feature $feature)
    {
        $feature->delete();
        return redirect('feature')->with("success", "Feature  deleted successfully");
    }

    // Permanent Delete
    public function delete($id)
    {
        $feature =  Feature::onlyTrashed()->where('id', $id)->first();
        unlink(base_path("public/uploads/feature/$feature->feature_photo"));
        $feature->forceDelete();
        return redirect('feature')->with("success", "Feature  deleted successfully");
    }
    // Restore Method
    public function restore($id)
    {
        Feature::onlyTrashed()->Where('id', $id)->restore();
        Feature::Where('id', $id)->update(['updated_by' => auth()->id()]);
        return back()->with("success", "Successfully Resored");
    }
}
