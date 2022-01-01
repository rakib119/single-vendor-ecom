<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Category;
use App\Models\Feature;
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
        return view('product_details', [
            'product' => Product::where('slug', $product_slug)->first()
        ]);
    }
}
