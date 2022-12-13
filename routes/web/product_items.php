<?php

use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->group(function() {

    //Create
    Route::get('/product/{product}/item/setup', [App\Http\Controllers\ProductItemController::class, 'create'])->name('product_item.create');
    Route::post('/product/{product}/item', [App\Http\Controllers\ProductItemController::class, 'store'])->name('product_item.store');
       
    //Update
    Route::get('/products/{product}/items/{product_item}/edit', [App\Http\Controllers\ProductItemController::class, 'edit'])->name('product_item.edit');
    Route::patch('/products/{product}/items/{product_item}/update', [App\Http\Controllers\ProductItemController::class, 'update'])->name('product_item.update');
    
    //Delete
    Route::delete('/products/{product}/Items/{product_item}/destroy', [App\Http\Controllers\ProductItemController::class, 'destroy'])->name('product_item.destroy');
});


