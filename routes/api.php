<?php

use App\http\Controllers\AuthController;
use App\http\Controllers\ReportController;
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


// public routes
Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);

// testing route
Route::get('/test', function() {
    return [
        'message' => 'This is a test open route',
    ];
});

/**
 * Middleware (sanctum)
 * 
 * protected routes (inside group)
 */
Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('/reports', [ReportController::class, 'index']);
    Route::get('/reports/{id}', [ReportController::class, 'show']);
    Route::post('/reports', [ReportController::class, 'store']);
    Route::delete('/reports/{id}', [ReportController::class, 'destroy']);
    Route::post('/logout', [AuthController::class, 'logout']);
});