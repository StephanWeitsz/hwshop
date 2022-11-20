<?php

use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->group(function() {

    //Create
    Route::get('/product/setup', [App\Http\Controllers\ProductController::class, 'create'])->name('product.create');
    Route::post('/products', [App\Http\Controllers\ProductController::class, 'store'])->name('product.store');
    
    //Read
    Route::get('/products', [App\Http\Controllers\ProductController::class, 'index'])->name('product.index');
    
    //Update
    Route::get('/product/{product}/edit', [App\Http\Controllers\ProductController::class, 'edit'])->name('product.edit');
    Route::patch('/products/{product}/update', [App\Http\Controllers\ProductController::class, 'update'])->name('product.update');
    
    //Delete
    Route::delete('/products/{product}/destroy', [App\Http\Controllers\ProductController::class, 'destroy'])->name('product.destroy');

});


