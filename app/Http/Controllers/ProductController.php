<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
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
        return view('product.index', [
            'products' => Product::all(),
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
            'product_photo' => 'required|mimes:jpg,JPG,jpeg,JPEG|dimensions:height=310,width=270',
            'regular_price' => 'required|integer',
            'discounted_price' => 'nullable|integer',
            'category_id' => 'required|integer',
            'subcategory_id' => 'required|integer',
            'short_description' => 'required',
            'description' => 'required',
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
        return view('product.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        return view('product.edit', [
            'product' => $product,
            'categories' => Category::all()

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
            'product_photo' => 'nullablle|mimes:jpg,JPG,jpeg,JPEG|dimensions:height=310,width=270',
            'regular_price' => 'required|integer',
            'discounted_price' => 'nullable|integer',
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
        unlink(base_path("public/uploads/products/$product->product_photo"));
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
        echo "hello";
    }
}
