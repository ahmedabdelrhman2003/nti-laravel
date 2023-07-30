<?php

use App\Http\Controllers\Apis\Auth\EmailVerficationController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\Apis\ProductController;
// use App\Http\Controllers\Apis\ProductController;
use App\Http\Controllers\Apis\ProductController;
use App\Http\Controllers\Apis\Auth\RegisterController;
use App\Http\Controllers\Apis\Auth\LoginController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('test', function () {
    echo 'test';
});
Route::get('/products', [ProductController::class, 'index'])->middleware('userverify');
Route::get('/products/edit/{id}', [ProductController::class, 'edit'])->middleware('userverify');
Route::post('/products/store', [ProductController::class, 'store'])->middleware('userverify');
Route::put('/products/update/{id}', [ProductController::class, 'update'])->middleware('userverify');
Route::delete('/products/destroy/{id}', [ProductController::class, 'destroy'])->middleware('userverify');



// Route::get('products', ['ProductController', 'index']);
// Route::get('products/edit/{id}', ['Apis\ProductController', 'edit']);
Route::prefix('users')->group(function () {
    Route::post('register', RegisterController::class);
    Route::post('send_code', [EmailVerficationController::class, 'sendCode']);
    Route::post('check_code', [EmailVerficationController::class, 'checkCode'])->middleware('auth.sanctum');
    Route::post('login', [LoginController::class, 'login']);
    Route::delete('logout', [LoginController::class, 'logout']);
    Route::delete('logout-all-devices', [LoginController::class, 'logout_All_Devices']);
});
