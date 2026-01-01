<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\QuranController;
use App\Http\Controllers\Api\RadiosController;
use App\Http\Controllers\Api\SurahsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\DuasController;
use App\Http\Controllers\Api\AzkarController;
use App\Http\Controllers\Api\DuaCategoriesController;
use App\Http\Controllers\Api\AzkarCategoriesController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('guest:sanctum')->group(function () {
    Route::controller(AuthController::class)->prefix('auth')->group(function () {
        Route::post('login', 'login');
        Route::post('register', 'register');
    });
});

Route::middleware('auth:sanctum')->group(function () {
    Route::controller(AuthController::class)->group(function() {
        Route::delete('auth/logout/{token?}', 'destroy');
    });
});

Route::apiResource('/dua-category', DuaCategoriesController::class);
Route::apiResource('/duas', DuasController::class);

Route::apiResource('/azkar-category', AzkarCategoriesController::class);
Route::apiResource('/azkar', AzkarController::class);

Route::apiResource('/radios', RadiosController::class);

Route::apiResource('/surahs', SurahsController::class);
