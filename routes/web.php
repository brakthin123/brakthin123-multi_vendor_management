<?php

use App\Http\Controllers\Admin\VendorController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Vendor\CategoryController;
use App\Http\Controllers\Vendor\ProductController;
use App\Http\Controllers\WelcomeController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [WelcomeController::class, 'welcome']);
Route::get('/login', [AuthController::class, 'login']);
Route::post('/login_post', [AuthController::class, 'login_post']);

Route::get('/registration', [AuthController::class, 'registration']);
Route::post('/registration_post', [AuthController::class, 'registration_post']);

// ------------------------- Super Admin Routes --------------------------------------- 

Route::group(['middleware' => 'superadmin'], function () {
    Route::get('superadmin/dashboard', [DashboardController::class, 'dashboard']);
    Route::get('superadmin/vendor/create', [VendorController::class, 'create']);

    Route::post('superadmin/vendor/create_post', [VendorController::class, 'registration_post'])->name('vendor.registration');
    Route::get('superadmin/vendor/table', [VendorController::class, 'list_vendors'])->name('superadmin.vendor.list');

    // Route to show the edit form
    Route::get('vendor/{id}/edit', [VendorController::class, 'edit'])->name('vendor.edit');

    Route::post('/vendor/{id}/update', [VendorController::class, 'update_post'])->name('vendor.update');

    // Route to delete a vendor
    Route::delete('/vendors/{id}', [VendorController::class, 'destroy'])->name('vendor.destroy');
});

// ------------------------- Vendor Routes --------------------------------------- 
Route::group(['middleware' => 'vendor'], function () {

    // Category routes
    Route::get('vendor/dashboard', [DashboardController::class, 'dashboard']);

    Route::get('vendor/category/create', [CategoryController::class, 'category_create'])->name('vendor.category.create');
    Route::post('vendor/category/store', [CategoryController::class, 'store'])->name('vendor.category.store');
    Route::get('vendor/category/list', [CategoryController::class, 'category_list'])->name('vendor.category.list');
    Route::get('vendor/category/edit/{id}', [CategoryController::class, 'category_edit'])->name('vendor.category.edit'); // Edit route
    Route::post('vendor/category/update/{id}', [CategoryController::class, 'update'])->name('vendor.category.update'); // Update route
    Route::delete('vendor/category/destroy/{id}', [CategoryController::class, 'destroy'])->name('vendor.category.destroy'); // Destroy route

    // Prodcut routes
    Route::get('vendor/product/list', [ProductController::class, 'product_list'])->name('vendor.product.list');
    Route::get('vendor/product/create', [ProductController::class, 'product_create'])->name('vendor.product.create');
    Route::post('vendor/product/store', [ProductController::class, 'product_store'])->name('vendor.product.store');
    Route::get('vendor/product/edit/{id}', [ProductController::class, 'product_edit'])->name('vendor.product.edit'); // Edit route
    Route::post('vendor/product/update/{id}', [ProductController::class, 'product_update'])->name('vendor.product.update'); // Update route
    Route::delete('vendor/product/destroy/{id}', [ProductController::class, 'product_destroy'])->name('vendor.product.destroy'); // Destroy route
});

// ------------------------- User Routes --------------------------------------- 
Route::group(['middleware' => 'user'], function () {
    Route::get('user/dashboard', [DashboardController::class, 'dashboard']);
});

Route::get('logout', [AuthController::class, 'logout']);
