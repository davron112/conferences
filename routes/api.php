<?php

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:api')->get('/v1/requests', [\App\Http\Controllers\Api\v1\RequestsController::class, 'index']);
Route::middleware('auth:api')->post('/v1/requests/approve', [\App\Http\Controllers\Api\v1\RequestsController::class, 'approve']);
Route::middleware('auth:api')->post('/v1/requests/cancel', [\App\Http\Controllers\Api\v1\RequestsController::class, 'cancel']);
Route::middleware('auth:api')->post('/v1/requests/send-message', [\App\Http\Controllers\Api\v1\RequestsController::class, 'sendMessage']);
Route::middleware('auth:api')->get('/v1/categories', [\App\Http\Controllers\Api\v1\CategoriesController::class, 'index']);
Route::post('/v1/auth/login', [\App\Http\Controllers\Api\v1\Admin\AuthController::class, 'login']);
