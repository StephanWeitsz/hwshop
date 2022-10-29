<?php

use Illuminate\Support\Facades\Route;

Route::post('/permissions',[App\Http\Controllers\PermissionController::class, 'store'])->name('permission.store');

Route::get('/permissions',[App\Http\Controllers\PermissionController::class, 'index'])->name('permissions.index');

Route::get('/permissions/{permission}/edit',[App\Http\Controllers\PermissionController::class, 'edit'])->name('permission.edit');
Route::patch('/permissions/{permission}/update',[App\Http\Controllers\PermissionController::class, 'update'])->name('permission.update');

Route::delete('/permissions/{permission}/destroy',[App\Http\Controllers\PermissionController::class, 'destroy'])->name('permission.destroy');

Route::put('/permissions/{permission}/attach',[App\Http\Controllers\PermissionController::class, 'attach_role'])->name('permission.role.attach');
Route::put('/permissions/{permission}/detach',[App\Http\Controllers\PermissionController::class, 'detach_role'])->name('permission.role.detach');