<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;

// Route::get('/', function () {
//     return view('home.index');
// });

Route::get('/', [HomeController::class,'index']);

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/home', [HomeController::class,'index'])->name('home.index');

Route::middleware(['checkAuthorization' , 'isAdmin'])->group(function () {
    Route::get('/admindashboard', [AdminController::class,'index'])->name('admin.admindashboard');
    
    // category routes
    Route::get('/categories',[CategoryController::class,'view_categories'])->name('categories');

    Route::post('/add_category',[CategoryController::class,'add_category'])->name('category.add');

    Route::get('/edit_category/{id}',[CategoryController::class,'edit_category'])->name('category.edit');
    Route::post('/update_category/{id}',[CategoryController::class,'update_category'])->name('category.update');

    Route::post('/delete_category/{id}',[CategoryController::class,'delete_category'])->name('category.destroy');
    
    // products routes
    Route::get('/products', [ProductController::class, 'index'])->name('products.index');

    Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
    Route::post('/store_products', [ProductController::class, 'store'])->name('products.store');

    Route::get('/products_edit/{id}', [ProductController::class, 'edit'])->name('products.edit');
    Route::post('/update_products/{id}', [ProductController::class, 'update'])->name('products.update');

    Route::post('/delete_products/{id}', [ProductController::class, 'destroy'])->name('products.destroy');


    Route::get('/product_details/{id}', [HomeController::class,'product_details'])->name('product_details');
});

Route::middleware(['checkAuthorization'])->group(function () {
    // cart routes
    Route::post('/add_cart/{id}',[HomeController::class,'add_cart'])->name('carts.add');
    Route::post('/remove_cart/{id}',[HomeController::class,'decrease_cart'])->name('carts.decrease');
    Route::get('/cash_order',[HomeController::class,'cash_order'])->name('carts.order');
});


require __DIR__.'/auth.php';
