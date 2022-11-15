<?php

use Illuminate\Support\Facades\Route;

Route::post('/utilities/addresses',[App\Http\Controllers\AddressTypeController::class, 'store'])->name('addresstype.store');

Route::get('/utilities/addresses',[App\Http\Controllers\AddressTypeController::class, 'index'])->name('addresstype.index');

Route::get('/utilities/addresses/{addresstype}/edit',[App\Http\Controllers\AddressTypeController::class, 'edit'])->name('addresstype.edit');
Route::patch('/utilities/addresses/{addresstype}/update',[App\Http\Controllers\AddressTypeController::class, 'update'])->name('addresstype.update');

Route::delete('/utilities/addresses/{addresstype}/destroy',[App\Http\Controllers\AddressTypeController::class, 'destroy'])->name('addresstype.destroy');


Route::post('/utilities/contacts',[App\Http\Controllers\ContactTypeController::class, 'store'])->name('contacttype.store');

Route::get('/utilities/contacts',[App\Http\Controllers\ContactTypeController::class, 'index'])->name('contacttype.index');

Route::get('/utilities/contacts/{contacttype}/edit',[App\Http\Controllers\ContactTypeController::class, 'edit'])->name('contacttype.edit');
Route::patch('/utilities/contacts/{contacttype}/update',[App\Http\Controllers\ContactTypeController::class, 'update'])->name('contacttype.update');

Route::delete('/utilities/contacts/{contacttype}/destroy',[App\Http\Controllers\ContactTypeController::class, 'destroy'])->name('contacttype.destroy');
