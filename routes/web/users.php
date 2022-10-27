<?php

use Illuminate\Support\Facades\Route;

//Admin User
Route::put('users/{user}/update',[App\Http\Controllers\UserController::class, 'update'])->name('user.profile.update');
Route::delete('user/{user}/destroy', [App\Http\Controllers\UserController::class, 'destroy'])->name('user.destroy');

Route::get('users/create',[App\Http\Controllers\UserController::class, 'create'])->name('user.create');
    
Route::middleware(['role:admin', 'auth'])->group(function() {
    Route::get('users',[App\Http\Controllers\UserController::class, 'index'])->name('users.index');
});

Route::middleware(['can:view,user'])->group(function() {
    Route::get('users/{user}/profile',[App\Http\Controllers\UserController::class, 'show'])->name('user.profile.show');
});