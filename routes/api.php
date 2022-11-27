<?php

use App\http\Controllers\AuthController;
use App\http\Controllers\ReportController;
use Illuminate\Http\Request;
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
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::get('/reports', [ReportController::class, 'index']);
Route::get('/reports/{id}', [ReportController::class, 'show']);
// Route::post('/reports', [ReportController::class, 'store']);




/**
 * Middleware (sanctum)
 * 
 * protected routes (inside group)
 */

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::post('/reports', [ReportController::class, 'store']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::delete('/reports/{id}', [ReportController::class, 'destroy']);
});