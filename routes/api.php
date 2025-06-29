<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserPanelController;
use App\Http\Controllers\DeveloperPublicController;

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