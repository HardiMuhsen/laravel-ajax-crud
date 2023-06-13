<?php

use App\Http\Controllers\employeeController;
use Illuminate\Support\Facades\Route;



Route::get('/', [employeeController::class, 'index']);
Route::post('/store', [employeeController::class, 'store'])->name('store');
Route::get('/fetch-all', [employeeController::class, 'fetchAll'])->name('fetchAll');
Route::delete('/delete', [employeeController::class, 'delete'])->name('delete');
Route::get('/edit', [employeeController::class, 'edit'])->name('edit');
Route::post('/update', [employeeController::class, 'update'])->name('update');