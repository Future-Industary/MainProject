<?php

use App\Http\Controllers\CartController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DevController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\UserController;
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::middleware('auth:sanctum')->group(function () {
Route::post('/developer/profile', [DevController::class, 'store']);
});

Route::post('/users/store',[UserController::class,'store']);

Route::get('/product/{id}',[ProductController::class, 'show']);

Route::get('/store', [StoreController::class, 'index']);

Route::post('/cart/add/{id}',[CartController::class, 'add']);

Route::post('/products/{id}/approve',[ProductController::class,'approve']);