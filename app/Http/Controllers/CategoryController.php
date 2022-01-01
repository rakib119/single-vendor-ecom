<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use App\Models\Category;
use App\Models\Subcategory;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Category::all();
        return view(
            "category.index",
            [
                "categories" => Category::all(),
                "deleted_category" => Category::onlyTrashed()->get()
            ]
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("category.create");
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
            "category_name" => "required|unique:categories",
            "category_photo" => "required|mimes:png,jpg"
        ], [
            "category_name.required" => "category name is required",
            "category_name.unique" => "name already taken"
        ]);
        if ($request->hasFile('category_photo')) {
            $photo_name = Str::random(8) . auth()->id() . "." . $request->file('category_photo')->getClientOriginalExtension();
            Image::make($request->file('category_photo'))->save(base_path("public/dashboard/uploads/category_photo/$photo_name"));
        }
        // return $request->category_name;
        Category::insert([
            "category_name" => $request->category_name,
            "category_photo" => $photo_name,
            "created_at" => Carbon::now(),
            "created_by" => auth()->id()
        ]);
        return back()->with("success", "Category  inserted successfully");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        return view('category.details', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        return view('category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        // option: 1
        // $category->update([
        //     'category_name' => $request->category_name
        // ]);

        //   option: 2
        $request->validate([
            "category_name" => "required | unique:categories,category_name," . $category->id,
            "category_photo" => "required|mimes:png,jpg"
        ]);
        if ($request->hasFile('category_photo')) {
            unlink(base_path("public/dashboard/uploads/category_photo/$category->category_photo"));
            $photo_name = Str::random(8) . auth()->id() . "." . $request->file('category_photo')->getClientOriginalExtension();
            Image::make($request->file('category_photo'))->save(base_path("public/dashboard/uploads/category_photo/$photo_name"));
        }
        $category->category_name = $request->category_name;
        $category->category_photo = $photo_name;
        $category->updated_by = auth()->id();
        $category->save();
        return  redirect('category')->with("success", "category  Updated successfully");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return back()->with("success", "category successfully deleted");
    }
    // Restore Method
    public function restore($id)
    {
        Category::onlyTrashed()->Where('id', $id)->restore();
        Category::Where('id', $id)->update(['updated_by' => auth()->id()]);
        return back()->with("success", "Successfully Resored");
    }
    // Delete method
    public function delete($id)
    {
        $category = Category::onlyTrashed()->where('id', $id)->first();
        // foreach ($category as  $cat) {}
        unlink(base_path("public/dashboard/uploads/category_photo/$category->category_photo"));
        Category::onlyTrashed()->Where('id', $id)->forceDelete();
        Subcategory::where('category_id', $id)->forceDelete();
        return back()->with("success", "Successfully Deleted");
    }
}
