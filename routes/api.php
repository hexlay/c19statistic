<?php

use App\Http\Controllers\Api\Auth\LoginController;
use App\Http\Controllers\Api\StatisticsController;
use Illuminate\Support\Facades\Route;

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

Route::prefix('auth')->controller(LoginController::class)->group(function () {
    Route::post('login', 'login');

    Route::middleware('auth:sanctum')->group(function () {
        Route::get('logout', 'logout');
    });
});

Route::middleware('auth:sanctum')->group(function () {
    Route::controller(StatisticsController::class)->group(function () {
        Route::get('country-data', 'getCountryData');
        Route::get('summary', 'getSummary');
    });
});
