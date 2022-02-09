<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Category;
use App\Models\Feature;
use App\Models\Inventory;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class FontendController extends Controller
{
    public  function index()
    {
        return view('index', [
            'categories' => Category::all(),
            'banners' => Banner::all(),
            'features' => Feature::all(),
            'products' => Product::all(),
        ]);
    }
    public  function productDetails($product_slug)
    {
        $product = Product::where('slug', $product_slug)->first();
        $related_product = Product::where('subcategory_id', $product->subcategory_id)->where('slug', '!=', $product_slug)->get();
        return view('product_details', [
            'product' => $product,
            'retated_product' => $related_product,
            'inventories' => Inventory::where('product_id', $product->id)->select('color_id')->groupBY('color_id')->get(),
            'total_inventories' => Inventory::where('product_id', $product->id)->sum('quantity')
        ]);
    }

    public  function getSizes(Request $request)
    {
        $str_size = "<option value=''>Select Size</option>";
        $sizes =   Inventory::where([
            'product_id' => $request->product_id,
            'color_id' => $request->color_id
        ])->get();
        foreach ($sizes as  $size) {
            $str_size .= "<option value='$size->size_id'>" . $size->getSize->size . "</option>";
        }
        echo  $str_size;
    }
    public  function getAvailableQty(Request $request)
    {

        $stock = Inventory::where([
            'product_id' => $request->product_id,
            'color_id' => $request->color_id,
            'size_id' => $request->size_id,
        ])->first();
        echo $stock->quantity;
    }
}
