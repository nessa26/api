<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderProductController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/', function () {
    echo "Aqui esta la apiProduct 1.0";
});

/*------------------------------------------------------------------ROUTERS PRODUCTS------------------------------------------------------------------------*/

Route::get('/products',[ProductController::class,'index']);
Route::get('/products/{id}',[ProductController::class,'show']);
Route::post('/products',[ProductController::class,'create']);
Route::put('/products/{id}',[ProductController::class,'update']);
Route::delete('/products/{id}',[ProductController::class,'delete']);

/*-----------------------------------------------------------------ROUTERS ORDERS------------------------------------------------------------------------*/

Route::get('/orders',[OrderController::class,'index']);
Route::get('/orders/{id}',[OrderController::class,'show']);
Route::post('/orders',[OrderController::class,'create']);
Route::put('/orders/{id}',[OrderController::class,'update']);
Route::delete('/orders/{id}',[OrderController::class,'delete']);

/*-----------------------------------------------------------------ROUTERS USERS-----------------------------------------------------------------------*/

Route::get('/users',[UserController::class,'index']);
Route::get('/users/{id}',[UserController::class,'show']);
Route::post('/users',[UserController::class,'create']);
Route::put('/users/{id}',[UserController::class,'update']);
Route::delete('/users/{id}',[UserController::class,'delete']);

/*-----------------------------------------------------------ROUTES ORDERS_PRODUCTS------------------------------------------------------------------------*/

Route::get('/orders-products',[OrderProductController::class,'index']);
Route::get('/orders-products/{id}',[OrderProductController::class,'show']);
Route::post('/orders-products',[OrderProductController::class,'create']);
Route::put('/orders-products/{id}',[OrderProductController::class,'update']);
Route::delete('/orders-products/{id}',[OrderProductController::class,'delete']);