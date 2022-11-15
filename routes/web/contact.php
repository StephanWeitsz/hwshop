<?php

use Illuminate\Support\Facades\Route;

Route::get('/users/{user}/profile/contact/create', [App\Http\Controllers\ContactController::class, 'create'])->name('contact.create');
Route::post('/users/{user}/profile/contact',[App\Http\Controllers\ContactController::class, 'store'])->name('contact.store');

Route::get('/users/{user}/profile/contacts',[App\Http\Controllers\ContactController::class, 'index'])->name('contact.index');

Route::get('/user/{user}/profile/contact/{contact}/edit',[App\Http\Controllers\ContactController::class, 'edit'])->name('contact.edit');
Route::patch('/user/{user}/profile/contact/{contact}/update',[App\Http\Controllers\ContactController::class, 'update'])->name('contact.update');

Route::delete('/users/{user}/profile/contact/{contact}/destroy',[App\Http\Controllers\ContactController::class, 'destroy'])->name('contact.destroy');
