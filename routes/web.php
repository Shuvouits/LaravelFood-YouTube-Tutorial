<?php

use App\Http\Controllers\admin\AdminProfileController;
use App\Http\Controllers\backend\AdminController;
use App\Http\Controllers\backend\CategoryController;
use App\Http\Controllers\backend\OptionalItemController;
use App\Http\Controllers\backend\ProductController;
use App\Http\Controllers\backend\ProductImageGalleryController;
use App\Http\Controllers\backend\ProductSizeController;
use App\Http\Controllers\backend\SettingController;
use App\Http\Controllers\frontend\FrontendController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// Admin Route

Route::get('/admin/login', [AdminController::class, 'login'])->name('admin.login');

Route::middleware(['auth', 'verified', 'roles:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::post('/logout', [AdminController::class, 'destroy'])->name('logout');

    /* Control Setting */
    Route::resource('setting', SettingController::class);

    /*  control Profile */
    Route::resource('profile', AdminProfileController::class);

    /*  Category Controller */
    Route::resource('category', CategoryController::class);

    Route::post('/category/bulk-delete', [CategoryController::class, 'bulkDelete'])->name('category.bulk-delete');

    /*  Product Controller */
    Route::resource('product', ProductController::class);
    Route::post('/product/bulk-delete', [ProductController::class, 'bulkDelete'])->name('product.bulk-delete');
    Route::get('/product-setting/{id}', [ProductController::class, 'productSetting'])->name('product.setting');

    Route::get('/product-gallery/{id}', [ProductController::class, 'productGallery'])->name('product.gallery');

    Route::resource('productSize', ProductSizeController::class);
    Route::resource('optionalItem', OptionalItemController::class);

    Route::resource('imageGallery', ProductImageGalleryController::class);

});

// user credentials

// user Route

Route::get('/dashboard', [FrontendController::class, 'dashboard'])->middleware(['auth', 'verified', 'roles:user'])->name('dashboard');

Route::get('/', function () {
    return view('welcome');
});

/*

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

*/

require __DIR__.'/auth.php';
