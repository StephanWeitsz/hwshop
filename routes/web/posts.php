<?php

use Illuminate\Support\Facades\Route;

//Create
Route::get('/posts/create', [App\Http\Controllers\PostController::class, 'create'])->name('post.create');
Route::post('/posts', [App\Http\Controllers\PostController::class, 'store'])->name('post.store');
    //Read
Route::get('/index', [App\Http\Controllers\PostController::class, 'index'])->name('post.index');
Route::get('/posts/all', [App\Http\Controllers\PostController::class, 'all'])->name('post.all');

    //Update
Route::get('/posts/{post}/edit', [App\Http\Controllers\PostController::class, 'edit'])->name('post.edit');
Route::patch('/posts/{post}/update', [App\Http\Controllers\PostController::class, 'update'])->name('post.update');
    //Delete
Route::delete('/posts/{post}/destroy', [App\Http\Controllers\PostController::class, 'destroy'])->name('post.destroy');

Route::get('/post/{post}', [App\Http\Controllers\PostController::class, 'show'])->name('post');