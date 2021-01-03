<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\IncomeController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;

Route::get('login', [AuthController::class, 'login'])->name('auth.login');
Route::post('login', [AuthController::class,'auth'])->name('auth');
Route::get('logout', [AuthController::class, 'logout'])->name('auth.logout');
Route::middleware(['auth'])->group(function() {
    Route::get('/', [DashboardController::class, 'dashboard']);
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
        Route::get('data', [IncomeController::class, 'data'])->name('income.data');
        Route::get('show/{id}', [IncomeController::class, 'show'])->name('income.show');
        Route::get('create', [IncomeController::class, 'create'])->name('income.create');
        Route::post('store', [IncomeController::class, 'store'])->name('income.store');
        Route::post('update/{id}', [IncomeController::class, 'update'])->name('income.update');
        Route::get('delete/{id}', [IncomeController::class, 'delete'])->name('income.delete');
    });
    Route::group(['prefix' => 'expense'], function () {
        Route::get('/', [ExpenseController::class, 'index'])->name('expense');
        Route::get('data', [ExpenseController::class, 'data'])->name('expense.data');
        Route::get('show/{id}', [ExpenseController::class, 'show'])->name('expense.show');
        Route::get('create', [ExpenseController::class, 'create'])->name('expense.create');
        Route::post('store', [ExpenseController::class, 'store'])->name('expense.store');
        Route::post('update/{id}', [ExpenseController::class, 'update'])->name('expense.update');
        Route::get('delete/{id}', [ExpenseController::class, 'delete'])->name('expense.delete');
    });
});
