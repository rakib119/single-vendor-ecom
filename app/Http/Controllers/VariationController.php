<?php

namespace App\Http\Controllers;

use App\Models\Color;
use App\Models\Size;
use Carbon\Carbon;
use Illuminate\Http\Request;

class VariationController extends Controller
{
    public function index()
    {
        $sizes = Size::all();
        $colors = Color::all();
        return view('variation.index', compact(['sizes', 'colors']));
    }
    public function createColor(Request $request)
    {
        $request->validate([
            'color_name' => 'required|max:40|unique:colors,color_name',
            'color_code' => 'required|max:20|unique:colors,color_code'
        ]);
        Color::insert([
            'color_name' => strtolower($request->color_name),
            'color_code' => $request->color_code,
            'created_by' => auth()->id(),
            'created_at' => Carbon::now()
        ]);
        return back()->with('success', 'Color added successfully');
    }
    public function createSize(Request $request)
    {
        $request->validate([
            'size' => 'required|max:20|unique:sizes,size',
        ]);
        Size::insert([
            'size' => strtoupper($request->size),
            'created_by' => auth()->id(),
            'created_at' => Carbon::now()
        ]);
        return back()->with('success', 'Size added successfully');
    }
}
