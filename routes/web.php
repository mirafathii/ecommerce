<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/home', [HomeController::class,'index'])->name('home.index');

// category
Route::get('/category',[CategoryController::class,'view_category'])->name('category');
Route::POST('/add_category',[CategoryController::class,'add_category'])->name('category.add');
Route::get('/delete_category/{id}',[CategoryController::class,'delete_category']);


// products routes
Route::get('/view_product',[ProductController::class,'view_product'])->name('products.view');
Route::post('/add_product',[ProductController::class,'add_product']);
Route::get('/show_product',[ProductController::class,'show_product'])->name('products.show');
Route::get('/delete_product/{id}',[ProductController::class,'delete_product'])->name('product.delete');
Route::get('/update_product/{id}',[ProductController::class,'edit_product'])->name('product.edit');
Route::post('/update_product_confirm/{id}',[ProductController::class,'update_product_confirm'])->name('products.update');
Route::get('/product_details/{id}', [ProductController::class,'product_details']);

// cart routes
Route::get('/product_details/{id}', [HomeController::class,'product_details']);
Route::post('/add_cart/{id}',[HomeController::class,'add_cart']);
Route::get('/show_cart',[HomeController::class,'show_cart']);
Route::get('/remove_cart/{id}',[HomeController::class,'remove_cart']);
Route::get('/cash_order',[HomeController::class,'cash_order']);


require __DIR__.'/auth.php';
