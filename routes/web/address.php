<?php

use Illuminate\Support\Facades\Route;

Route::get('/users/{user}/profile/address/create', [App\Http\Controllers\AddressController::class, 'create'])->name('address.create');
Route::post('/users/{user}/profile/address',[App\Http\Controllers\AddressController::class, 'store'])->name('address.store');

Route::get('/users/{user}/profile/addresses',[App\Http\Controllers\AddressController::class, 'index'])->name('address.index');

Route::get('/user/{user}/profile/address/{address}/edit',[App\Http\Controllers\AddressController::class, 'edit'])->name('address.edit');
Route::patch('/user/{user}/profile/address/{address}/update',[App\Http\Controllers\AddressController::class, 'update'])->name('address.update');

Route::delete('/users/{user}/profile/address/{address}/destroy',[App\Http\Controllers\AddressController::class, 'destroy'])->name('address.destroy');
