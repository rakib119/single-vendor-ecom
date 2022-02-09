<?php

namespace App\Http\Controllers;

use App\Models\Color;
use App\Models\Inventory;
use App\Models\Product;
use App\Models\Size;
use Carbon\Carbon;
use Illuminate\Http\Request;

class InventoryController extends Controller
{

    public function addInventory($product_id)
    {
        return view('inventory.create', [
            'sizes' => Size::all(),
            'colors' => Color::all(),
            'product' => Product::where('id', $product_id)->first(),
            'inventories' => Inventory::where('product_id', $product_id)->get(),
        ]);
    }
    public function store(Request $request, $product_id)
    {
        $request->validate([
            'color' => 'required|integer',
            'size' => 'required|integer',
            'quantity' => 'required|integer',
        ]);
        $inventory_info = Inventory::where([
            'color_id' => $request->color,
            'size_id' => $request->size,
            'product_id' => $product_id,
        ]);
        $is_exist = $inventory_info->exists();
        if ($is_exist) {
            $inventory_info->increment('quantity', $request->quantity);
            $inventory = $inventory_info->first();
            $inventory->updated_by = auth()->id();
            $inventory->save();
            return back()->with('success', 'Inventory updated successfully');
        } else {
            Inventory::insert([
                'color_id' => $request->color,
                'size_id' => $request->size,
                'product_id' => $product_id,
                'quantity' => $request->quantity,
                'created_at' => Carbon::now(),
                'created_by' => auth()->id(),
            ]);
            return back()->with('success', 'Inventory added successfully');
        }
    }
}
