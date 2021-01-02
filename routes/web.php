<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\IncomeController;

Route::get('/', function () {
    return view('dashboard');
});
Route::group(['prefix' => 'blog'], function () {
    Route::get('/', [BlogController::class, 'index'])->name('blog');
    Route::get('data', [BlogController::class, 'data'])->name('blog.data');
    Route::get('show/{id}', [BlogController::class, 'show'])->name('blog.show');
    Route::get('create', [BlogController::class, 'create'])->name('blog.create');
    Route::post('store', [BlogController::class, 'store'])->name('blog.store');
    Route::post('update/{id}', [BlogController::class, 'update'])->name('blog.update');
    Route::get('delete/{id}', [BlogController::class, 'delete'])->name('blog.delete');
});
Route::group(['prefix' => 'incomes'], function () {
    Route::get('/', [IncomeController::class, 'index'])->name('income');
    Route::get('create', [IncomeController::class, 'create'])->name('income.create');
    Route::post('store', [IncomeController::class, 'store'])->name('income.store');
});
