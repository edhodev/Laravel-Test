<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

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
