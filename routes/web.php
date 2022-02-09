<?php

use App\Http\Controllers\BannerController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\FontendController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\FeatureController;
use App\Http\Controllers\SubcategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardCotroller;
use App\Http\Controllers\FeaturePhotoController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\VariationController;

// dashboard home
Auth::routes();
Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/admin', [DashboardCotroller::class, 'index'])->name('admin');
// profile
Route::get('/profile', [ProfileController::class, 'profile'])->name('profile');
Route::post('profile/update', [ProfileController::class, 'updateProfile'])->name('profile.update');
Route::post('profile/changePassword', [ProfileController::class, 'changePassword'])->name('profile.changePassword');
Route::post('change/profile-picture', [ProfileController::class, 'changeProfilePicture'])->name('profile.change_profile_picture');
Route::post('change/cover-photo', [ProfileController::class, 'changeCoverPhoto'])->name('profile.change_cover_photo');
// category
Route::resource('category', CategoryController::class);
Route::get('/restore/{id}', [CategoryController::class, 'restore'])->name('category.restore');
Route::get('/delete/{id}', [CategoryController::class, 'delete'])->name('category.delete');
// subcategory
Route::resource('subcategory', SubcategoryController::class);
// banner
Route::resource('banner', BannerController::class);
Route::post('banner/delete/{id}', [BannerController::class, 'delete'])->name('banner.delete');
Route::get('banner/restore/{id}', [BannerController::class, 'restore'])->name('banner.restore');
// feature
Route::resource('feature', FeatureController::class);
Route::post('feature/delete/{id}', [FeatureController::class, 'delete'])->name('feature.delete');
Route::get('feature/restore/{id}', [FeatureController::class, 'restore'])->name('feature.restore');
// Product
// Route::resource('product', ProductController::class)->parameters(['product' => 'slug']);
Route::resource('product', ProductController::class);
Route::post('product/get_subcat', [ProductController::class, 'getSubCat'])->name('product.get_subcat');
Route::post('product/delete/{id}', [ProductController::class, 'delete'])->name('product.delete');
Route::get('product/restore/{id}', [ProductController::class, 'restore'])->name('product.restore');
// feature photo
Route::resource('feature_photo', FeaturePhotoController::class);
Route::get('feature/list/{slug}', [FeaturePhotoController::class, 'featureList'])->name('feature_list');
// Variation Manager
Route::get('variation', [VariationController::class, 'index'])->name('variation.index');
Route::post('variation/submit/color', [VariationController::class, 'createColor'])->name('variation.color_post');
Route::post('variation/submit/size', [VariationController::class, 'createSize'])->name('variation.size_post');
// Inventory
Route::get('add-inventory/{product_id}', [InventoryController::class, 'addInventory'])->name('inventory.index');
Route::post('inventory/store/{product_id}', [InventoryController::class, 'store'])->name('inventory.store');
// Font End
Route::get('/', [FontendController::class, 'index'])->name('index');
Route::post('get/sizes', [FontendController::class, 'getSizes'])->name('get_sizes');
Route::post('get/available/qty', [FontendController::class, 'getAvailableQty'])->name('get_available_qty');
Route::get('product/details/{product_slug}', [FontendController::class, 'productDetails'])->name('product.product_details');

