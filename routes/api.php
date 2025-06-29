<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DevController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\adminController;
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::middleware('auth:sanctum')->group(function () {
Route::post('/developer/profile', [DevController::class, 'store']);
});



Route::post('/users/store',[UserController::class,'store']);

Route::get('/product/{id}',[ProductController::class, 'show']);

Route::get('/store', [StoreController::class, 'index']);

Route::post('/products/{id}/approve',[ProductController::class,'approve']);


#Admin APIs
Route::post('/admin/login',[adminController::class,'login']);

Route::middleware('auth:admin')->prefix('admin')->group(function () {
    Route::get('/profile', function (Request $req) {
        return $req->user();
    });
    Route::get('/users', [UserController::class,'showUsers']);
    Route::get('/users/{id}', [UserController::class,'searchUser']);
    Route::delete('/users/{id}', [UserController::class, 'destroy']);
    Route::get('/product',[adminController::class,'showProduct']);
    Route::get('/product/{id}',[adminController::class,'searchProduct']);

});

