<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


use App\Http\Controllers\UserPanelController;
use App\Http\Controllers\DeveloperPublicController;
use App\Http\Controllers\DevController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ProfessorController;
use App\Http\Controllers\ProductImageController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\adminController;
use App\Http\Controllers\ArticleController;


// Users
Route::post('/users/store', [UserController::class, 'store']);
Route::get('/users', [UserController::class, 'index']);
Route::get('/users/{id}', [UserController::class, 'show']);
Route::put('/users/{id}', [UserController::class, 'update']);
Route::delete('/users/{id}', [UserController::class, 'destroy']);

// Auth
Route::post('/login', [UserController::class, 'login']);
Route::post('/logout', [UserController::class, 'logout']);

//Products
Route::get('/products', [ProductController::class, 'index']);
Route::get('/products/{id}', [ProductController::class, 'show']);
Route::post('/products', [ProductController::class, 'store']);
Route::put('/products/{id}', [ProductController::class, 'update']);
Route::delete('/products/{id}', [ProductController::class, 'destroy']);
Route::post('/products/{id}/approve', [ProductController::class, 'approve']);
Route::get('/store', [StoreController::class, 'index']);

//Comments
Route::get('/products/{id}/comments', [CommentController::class, 'index']);
Route::post('/products/{id}/comments', [CommentController::class, 'store']);
Route::put('/comments/{id}', [CommentController::class, 'update']);
Route::delete('/comments/{id}', [CommentController::class, 'destroy']);

// Categories
Route::get('/categories', [CategoryController::class, 'index']);
Route::get('/categories/{id}', [CategoryController::class, 'show']);
Route::post('/categories', [CategoryController::class, 'store']);
Route::put('/categories/{id}', [CategoryController::class, 'update']);
Route::delete('/categories/{id}', [CategoryController::class, 'destroy']);

// Product Images
Route::get('/products/{id}/images', [ProductImageController::class, 'index']);
Route::post('/products/{id}/images', [ProductImageController::class, 'store']);
Route::delete('/product_images/{id}', [ProductImageController::class, 'destroy']);

// Professors
Route::get('/professors', [ProfessorController::class, 'index']);
Route::get('/professors/{id}', [ProfessorController::class, 'show']);
Route::post('/professors', [ProfessorController::class, 'store']);
Route::put('/professors/{id}', [ProfessorController::class, 'update']);
Route::delete('/professors/{id}', [ProfessorController::class, 'destroy']);

// Articles
Route::get('/articles', [ArticleController::class, 'index']);
Route::get('/articles/{id}', [ArticleController::class, 'show']);
Route::post('/articles', [ArticleController::class, 'store']);
Route::put('/articles/{id}', [ArticleController::class, 'update']);
Route::delete('/articles/{id}', [ArticleController::class, 'destroy']);





Route::get('/user', function (Request $request) {
    return $request->user();}) ->middleware('auth:sanctum');

Route::middleware('auth:sanctum')->group(function () {
Route::post('/developer/profile', [DevController::class, 'store']);
});


Route::middleware(['auth:sanctum'])->group(function () {
Route::get('/me/profile', [UserPanelController::class, 'showProfile']);
Route::get('/me/projects', [UserPanelController::class, 'myProjects']);
});




Route::prefix('auth')->group(function () {
    Route::post('login',[\App\Http\Controllers\AuthController::class,'login']);
    Route::post('register',[\App\Http\Controllers\AuthController::class,'register']);
    Route::middleware('auth:sanctum')->post('/logout', [AuthController::class, 'logout']);
});

# Admin APIs
Route::post('/admin/login', [adminController::class, 'login'])->name('login');

Route::middleware('auth:admin')->prefix('admin')->group(function () {
    Route::get('/profile', [adminController::class, 'profile']);
    Route::put('/profile', [adminController::class, 'updateProfile']);
    Route::get('/users', [adminController::class, 'showUsers']);
    Route::get('/users/{id}', [adminController::class, 'searchUser']);
    Route::delete('/users/{id}', [adminController::class, 'destroyUser']);
    Route::get('/products', [adminController::class, 'showProduct']);
    Route::get('/products/{id}', [adminController::class, 'searchProduct']);
    Route::delete('/products/{id}', [adminController::class, 'destroyProduct']);
});


