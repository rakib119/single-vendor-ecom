<?php

namespace App\Http\Controllers;

use App\Models\FeaturePhoto;
use App\Models\Product;
use Carbon\Carbon;
use Facade\FlareClient\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class FeaturePhotoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Response $response)
    {
        return $response;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        if ($request->pid ||  Product::where('slug', $request->pid)->first()) {
            return view('product_feature.create', [
                'product' => Product::where('slug', $request->pid)->first()
            ]);
        } else {
            return back();
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $ss = $request->file('photo_name');

        // foreach ($ss as $key) {
        //     $ext =$key->getClientOriginalExtension();

        //     echo $ext;
        // }
        $product = Product::where('slug', $request->slug)->first();
        $request->validate([
            'photo_name' => 'required',
            'photo_name.*' => 'mimes:png,jpg'
        ], [
            'photo_name.mimes' => 'The photo must be a file of type: png, jpg.'
        ]);
        foreach ($request->file('photo_name') as $product_photo) {
            $photo_name = Str::random(10) . "-$product->id" . '.' . $product_photo->getClientOriginalExtension();
            Image::make($product_photo)->save(base_path('public\uploads\product_feature_photo' . '/' . $photo_name));
            FeaturePhoto::insert([
                'product_id' => $product->id,
                'photo_name' => $photo_name,
                'created_by' => auth()->id(),
                'created_at' => Carbon::now()
            ]);
        }
        return back()->with('success', 'Added succcessfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\FeaturePhoto  $featurePhoto
     * @return \Illuminate\Http\Response
     */
    public function show(FeaturePhoto $featurePhoto)
    {
    }
    public function featureList($id)
    {
        $feature_photos = DB::table('feature_photos')
            ->join('products', 'feature_photos.product_id', '=', 'products.id')
            ->select(['feature_photos.*', 'products.product_name', 'products.product_photo', 'products.slug'])
            ->where('feature_photos.product_id', '=', $id);
        return view('product_feature.show', [
            'feature_photos' => $feature_photos->get(),
            'feature_photo' => $feature_photos->first()
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\FeaturePhoto  $featurePhoto
     * @return \Illuminate\Http\Response
     */
    public function edit(FeaturePhoto $featurePhoto)
    {
        return view('product_feature.edit', compact('featurePhoto'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\FeaturePhoto  $featurePhoto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, FeaturePhoto $featurePhoto)
    {
        $request->validate([
            'photo_name' => 'required|mimes:png,jpg',
        ], [
            'photo_name.mimes' => 'The photo must be a file of type: png, jpg.'
        ]);
        $photo_location = base_path("public/uploads/product_feature_photo/$featurePhoto->photo_name");
        if (file_exists($photo_location)) {
            unlink($photo_location);
        }

        $photo_name = Str::random(10) . "-$featurePhoto->product_id" . '.' . $request->photo_name->getClientOriginalExtension();
        Image::make($request->file('photo_name'))->save(base_path('public\uploads\product_feature_photo' . '/' . $photo_name));

        $featurePhoto->photo_name = $photo_name;
        $featurePhoto->updated_at = Carbon::now();
        $featurePhoto->save();
        return redirect()->route('feature_list', $featurePhoto->product_id)->with('success', 'successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\FeaturePhoto  $featurePhoto
     * @return \Illuminate\Http\Response
     */
    public function destroy(FeaturePhoto $featurePhoto)
    {
        $photo_location = base_path("public/uploads/product_feature_photo/$featurePhoto->photo_name");
        if (file_exists($photo_location)) {
            unlink($photo_location);
        }
        $featurePhoto->delete();
        return back()->with('success', 'Successfully deleted');
    }
}
