<?php

use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->group(function() {

    //Create
    Route::get('/product/{product}/item/{product_item}/element/setup', [App\Http\Controllers\ProductElementController::class, 'create'])->name('product_element.create');
    Route::post('/product/{product}/item/{product_item}/element', [App\Http\Controllers\ProductElementController::class, 'store'])->name('product_element.store');
       
    //Update
    Route::get('/products/{product}/items/{product_item}/element/{product_element}/edit', [App\Http\Controllers\ProductElementController::class, 'edit'])->name('product_element.edit');
    Route::patch('/products/{product}/items/{product_item}/element/{product_element}/update', [App\Http\Controllers\ProductElementController::class, 'update'])->name('product_element.update');
    
    //Delete
    Route::delete('/products/{product}/Items/{product_item}/element/{product_element}/destroy', [App\Http\Controllers\ProductElementController::class, 'destroy'])->name('product_element.destroy');

});


