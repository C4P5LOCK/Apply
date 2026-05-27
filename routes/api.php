<?php

use Illuminate\Http\Request;
use App\Models\Application;
use App\Http\Resources\ApplicationResource;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

use App\Http\Controllers\Api\ApplicationApiController;

Route::get('/applications', [ApplicationApiController::class, 'index']);
Route::post('/applications', [ApplicationApiController::class, 'store']);