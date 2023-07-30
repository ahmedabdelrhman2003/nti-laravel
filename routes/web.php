<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\dashboard\ProductController;
use App\Http\Controllers\users\UserController;
use App\Http\Controllers\DashboardController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('/', function () {
    return view('welcome');
});


Route::prefix('dashboard')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->middleware('verified');
    Route::prefix('products')->group(function () {
        Route::get('/', [ProductController::class, 'index'])->name('products.index')->middleware('verified');
        Route::get('/create', [ProductController::class, 'create'])->name('products.create')->middleware('verified');
        Route::post('/store', [ProductController::class, 'store'])->name('products.store')->middleware('verified');
        Route::get('/edit/{id}', [ProductController::class, 'edit'])->name('products.edit')->middleware('verified');

        // Route::delete('/update/{id}',[ ProductController::class,'update'])->name('products.update');
        Route::put('update/{id}', [ProductController::class, 'update'])->name('products.update')->middleware('verified');
        Route::delete('/destroy/{id}', [ProductController::class, 'destroy'])->name('products.destroy')->middleware('verified');
        // Route::resource('products', ProductController::class);


    })->middleware('auth');
    Route::prefix('users')->group(function () {
        Route::get('/', [UserController::class, 'show'])->name('users.index');
        Route::post('/create', [UserController::class, 'create'])->name('users.create');
        Route::get('/edit/{id}', [UserController::class, 'edit'])->name('users.edit');
        Route::delete('/destrot/{id}', [UserController::class, 'destroy'])->name('users.destroy');
    });
});

Auth::routes(['verify' => true]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
