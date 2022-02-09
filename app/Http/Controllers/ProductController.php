<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\FeaturePhoto;
use App\Models\Product;
use App\Models\Subcategory;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Str;



class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // return DB::table('products')
        //     ->join('categories', 'products.category_id', '=', 'categories.id')
        //     ->join('feature_photos', 'products.id', '=', 'feature_photos.product_id')
        //     ->select('products.*', 'categories.category_name', 'feature_photos.product_id')
        //     ->get();
        return view('product.index', [

            'products' => DB::table('products')
                ->join('categories', 'products.category_id', '=', 'categories.id')
                ->select('products.*', 'categories.category_name')
                ->where('products.deleted_at', NULL)
                ->get(),
            'deleted_products' => Product::onlyTrashed()->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('product.create', [
            'categories' => Category::all()
        ]);
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
            'product_name' => 'required',
            'product_photo' => 'required|mimes:jpg,jpeg|dimensions:height=310,width=270',
            'regular_price' => 'required|integer',
            'discounted_price' => 'nullable|integer|lte:regular_price',
            'category_id' => 'required|integer',
            'subcategory_id' => 'required|integer',
            'short_description' => 'required',
            'description' => 'required',
        ], [
            'product_photo.dimensions' => 'The product photo dimensions should be 310 * 270'
        ]);

        $product_photo = Str::random(8) . auth()->id() . "." . $request->file('product_photo')->getClientOriginalExtension();
        Image::make($request->file('product_photo'))->save(base_path("public/uploads/products/$product_photo"));
        if ($request->discounted_price == NULL) {
            $request->discounted_price =  $request->regular_price;
        }
        Product::insert([
            'product_name' => $request->product_name,
            'product_photo' => $product_photo,
            'slug' =>  Str::slug($request->product_name),
            'product_code' => Str::random(8),
            'regular_price' => $request->regular_price,
            'discounted_price' => $request->discounted_price,
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'short_description' => $request->short_description,
            'description' => $request->description,
            'weight' => $request->weight,
            'dimensions' => $request->dimensions,
            'materials' => $request->materials,
            'other_info' => $request->other_info,
            'created_by' => auth()->id(),
            'created_at' => Carbon::now(),

        ]);
        return redirect('product')->with('success', 'Product added successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        $feature_photos = FeaturePhoto::where('product_id', $product->id)->get();
        return view('product.show', compact('product', 'feature_photos'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $categories = Category::all();
        $sub_categories = Subcategory::where('category_id', $product->category_id)->get();
        return view('product.edit', [
            'product' => $product,
            'categories' => $categories,
            'subcategories' => $sub_categories

        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'product_name' => 'required',
            'product_photo' => 'nullable|mimes:jpg,jpeg|dimensions:height=310,width=270',
            'regular_price' => 'required|integer',
            'discounted_price' => 'nullable|integer|lte:regular_price',
            'category_id' => 'required|integer',
            'subcategory_id' => 'required|integer',
            'short_description' => 'required',
            'description' => 'required',
        ]);
        if ($request->hasFile('product_photo')) {
            unlink(base_path("public/uploads/products/$product->product_photo"));
            $product_photo = Str::random(8) . auth()->id() . "." . $request->file('product_photo')->getClientOriginalExtension();
            Image::make($request->file('product_photo'))->save(base_path("public/uploads/products/$product_photo"));
            $product->product_photo = $product_photo;
            $product->save();
        }
        if ($request->discounted_price == NULL) {
            $request->discounted_price =  $request->regular_price;
        }
        $product->product_name = $request->product_name;
        $product->slug =  Str::slug($request->product_name);
        $product->regular_price = $request->regular_price;
        $product->discounted_price = $request->discounted_price;
        $product->category_id = $request->category_id;
        $product->subcategory_id = $request->subcategory_id;
        $product->short_description = $request->short_description;
        $product->description = $request->description;
        $product->weight = $request->weight;
        $product->dimensions = $request->dimensions;
        $product->materials = $request->materials;
        $product->other_info = $request->other_info;
        $product->updated_by = auth()->id();
        $product->save();
        return redirect('product')->with('success', 'Product updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect('product')->with('success', 'Product deleted successfully');
    }
    public function delete($id)
    {
        $product =  Product::onlyTrashed()->where('id', $id)->first();
        $photo_location = base_path("public/uploads/products/$product->product_photo");
        if (file_exists($photo_location)) {
            unlink($photo_location);
        }
        $product->forceDelete();
        return redirect('product')->with("success", "Product  deleted successfully");
    }
    // Restore Method
    public function restore($id)
    {
        Product::onlyTrashed()->Where('id', $id)->restore();
        Product::Where('id', $id)->update(['updated_by' => auth()->id()]);
        return back()->with("success", "Successfully Resored");
    }
    public function getSubCat(Request $request)
    {
        $sub_categories = Subcategory::where('category_id', $request->category_id)->get();
        if ($sub_categories->count() == 0) {
            $string_to_send = "<option value=''>--No Data Yet--</option>";
        } else {
            $string_to_send = "<option value=''>--Choose One--</option>";
        }
        foreach ($sub_categories as $sub_category) {
            $string_to_send .= " <option $sub_category->id == old('subcategory_id') ? 'selected' : ''  value='$sub_category->id'> $sub_category->subcategory_name </option>";
        }
        echo $string_to_send;
    }
}
