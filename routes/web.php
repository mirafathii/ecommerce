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

// category routes
Route::get('/categories',[CategoryController::class,'view_categories'])->name('categories');

Route::post('/add_category',[CategoryController::class,'add_category'])->name('category.add');

Route::get('/edit_category/{id}',[CategoryController::class,'edit_category'])->name('category.edit');
Route::post('/update_category/{id}',[CategoryController::class,'update_category'])->name('category.update');

Route::post('/delete_category/{id}',[CategoryController::class,'delete_category'])->name('category.destroy');


// products routes
// Route::get('/view_product',[ProductController::class,'view_product'])->name('products.view');
// Route::post('/add_product',[ProductController::class,'add_product']);
// Route::get('/show_product',[ProductController::class,'show_product'])->name('products.show');
// Route::get('/delete_product/{id}',[ProductController::class,'delete_product'])->name('product.delete');
// Route::get('/update_product/{id}',[ProductController::class,'edit_product'])->name('product.edit');
// Route::post('/update_product_confirm/{id}',[ProductController::class,'update_product_confirm'])->name('products.update');
// Route::get('/product_details/{id}', [ProductController::class,'product_details']);

Route::get('/products', [ProductController::class, 'index'])->name('products.index');

Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
Route::post('/products', [ProductController::class, 'store'])->name('products.store');

Route::get('/products/{id}/edit', [ProductController::class, 'edit'])->name('products.edit');
Route::post('/products/{id}', [ProductController::class, 'update'])->name('products.update');

Route::post('/products/{id}', [ProductController::class, 'destroy'])->name('products.destroy');

// cart routes
Route::get('/product_details/{id}', [HomeController::class,'product_details']);
Route::post('/add_cart/{id}',[HomeController::class,'add_cart']);
Route::get('/show_cart',[HomeController::class,'show_cart']);
Route::get('/remove_cart/{id}',[HomeController::class,'remove_cart']);
Route::get('/cash_order',[HomeController::class,'cash_order']);


require __DIR__.'/auth.php';
