<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;




use App\Http\Controllers\UserPanelController;
use App\Http\Controllers\DeveloperPublicController;
use App\Http\Controllers\DevController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\adminController;

Route::get('/user', function (Request $request) {
    return $request->user();}) ->middleware('auth:sanctum');

Route::middleware('auth:sanctum')->group(function () {
Route::post('/developer/profile', [DevController::class, 'store']);
});


Route::middleware(['auth:sanctum'])->group(function () {
Route::get('/me/profile', [UserPanelController::class, 'showProfile']);
Route::get('/me/projects', [UserPanelController::class, 'myProjects']);
});

Route::get('/user/{id}', [UserPanelController::class, 'show']);
Route::post('/users/store',[UserController::class,'store']);

Route::get('/product/{id}',[ProductController::class, 'show']);

Route::get('/store', [StoreController::class, 'index']);

Route::post('/products/{id}/approve',[ProductController::class,'approve']);

Route::prefix('auth')->group(function () {
    Route::post('login',[\App\Http\Controllers\AuthController::class,'login']);
    Route::post('register',[\App\Http\Controllers\AuthController::class,'register']);
    Route::middleware('auth:sanctum')->post('/logout', [AuthController::class, 'logout']);
});

# Admin APIs
Route::post('/admin/login', [adminController::class, 'login']);

Route::middleware('auth:admin')->prefix('admin')->group(function () {
    Route::get('/profile', [adminController::class, 'profile']);
    Route::put('/profile', [adminController::class, 'updateProfile']);
    Route::get('/users', [adminController::class, 'showUsers']);
    Route::get('/users/{id}', [adminController::class, 'searchUser']);
    Route::delete('/users/{id}', [adminController::class, 'destroy']);
    Route::get('/products', [adminController::class, 'showProduct']);
    Route::get('/products/{id}', [adminController::class, 'searchProduct']);
});


