<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DevController;
use App\Http\Controllers\UsersController;
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::middleware('auth:sanctum')->group(function () {
Route::post('/developer/profile', [DevController::class, 'store']);
});

Route::post('/users/store',[UsersController::class,'store']);
