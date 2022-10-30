<?php

use Illuminate\Support\Facades\Route;

Route::post('/utilities/addresses',[App\Http\Controllers\AddressTypeController::class, 'store'])->name('addressType.store');

Route::get('/utilities/addresses',[App\Http\Controllers\AddressTypeController::class, 'index'])->name('addressType.index');

Route::get('/utilities/addresses/{addresstype}/edit',[App\Http\Controllers\AddressTypeController::class, 'edit'])->name('addressType.edit');
Route::patch('/utilities/addresses/{addresstype}/update',[App\Http\Controllers\AddressTypeController::class, 'update'])->name('addressType.update');

Route::delete('/utilities/addresses/{addresstype}/destroy',[App\Http\Controllers\AddressTypeController::class, 'destroy'])->name('addressType.destroy');
