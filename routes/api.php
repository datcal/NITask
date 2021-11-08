<?php

use App\Http\Controllers\AuthenticationController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
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

Route::group(['middleware' => ['auth:sanctum','log.route']], function () {
    Route::get('/products',[ProductController::class,'listProduct']);
    Route::get('/user',[UserController::class,'getUser']);
    Route::get('/user/products',[UserController::class,'listProduct']);
    Route::post('/user/products',[UserController::class,'createOrder']);
    Route::delete('/user/products/{SKU}',[UserController::class,'deleteOrder']);
});



