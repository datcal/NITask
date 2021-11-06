<?php

use App\Http\Controllers\AuthenticationController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OrderController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/auth', [AuthenticationController::class,'auth']);

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('/products',[ProductController::class,'index']);
    Route::get('/user',[UserController::class,'index']);
    Route::get('/user/products',[UserController::class,'product']);
    Route::post('/user/products',[OrderController::class,'store']);
    Route::delete('/user/products/{SKU}',[OrderController::class,'destroy']);
});



