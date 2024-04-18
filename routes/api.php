<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BranchController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CurrencyController;
use App\Http\Controllers\RegionController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// auth routes
Route::post('/signUp', [AuthController::class, 'signUp']);
Route::post('/login', [AuthController::class, 'login']);

// User crud routes
Route::apiResource('users', UserController::class);

// Brand crud routes
Route::post('/brands/{id}', [BrandController::class, 'update']);
Route::apiResource('brands', BrandController::class);

// Branch crud routes
Route::post('/branches/{id}', [BranchController::class, 'update']);
Route::apiResource('branches', BranchController::class);

// Regions route
Route::get('/regions', [RegionController::class, 'index']);

Route::middleware('auth:sanctum')->group(function () {
    // Logout route
    Route::post('/logout', [AuthController::class, 'logout']);
});


// Currency sync route
Route::get('/syncCurrencies', [CurrencyController::class, 'syncCurrencies']);
