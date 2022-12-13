<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/products', [App\Http\Controllers\HomeController::class, 'products'])->name('products');
Route::get('/products/{product}', [App\Http\Controllers\HomeController::class, 'product'])->name('product');
Route::get('/products/{product}/{product_item}', [App\Http\Controllers\HomeController::class, 'product_item'])->name('product_item');


Route::middleware('auth')->group(function() {
    Route::get('/admin', [App\Http\Controllers\AdminController::class, 'index'])->name('admin.index');
});


