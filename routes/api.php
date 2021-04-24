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

// site
Route::get('/v1/conferences', [
    \App\Http\Controllers\Api\v1\ConferencesController::class, 'index'
]);
// site
Route::get('/v1/conferences/{id}', [
    \App\Http\Controllers\Api\v1\ConferencesController::class, 'show'
]);
// site
Route::get('/v1/categories/conference/{id}', [
    \App\Http\Controllers\Api\v1\ConferencesController::class, 'categories'
]);
// site
Route::post('/v1/request/create', [
    \App\Http\Controllers\Api\v1\RequestsController::class, 'store'
]);
// site
Route::post('/v1/request/check-otp', [
    \App\Http\Controllers\Api\v1\RequestsController::class, 'checkOtp'
]);

//admin
Route::middleware('auth:api')->get('/v1/admin/conferences', [\App\Http\Controllers\Api\v1\Admin\ConferencesController::class, 'index']);
Route::middleware('auth:api')->get('/v1/admin/conferences/{id}', [\App\Http\Controllers\Api\v1\Admin\ConferencesController::class, 'show']);

Route::middleware('auth:api')->get('/v1/admin/users', [\App\Http\Controllers\Api\v1\Admin\UsersController::class, 'index']);
Route::middleware('auth:api')->get('/v1/admin/users/{id}', [\App\Http\Controllers\Api\v1\Admin\UsersController::class, 'show']);

Route::post('/v1/login-otp', [\App\Http\Controllers\Api\v1\Admin\AuthController::class, 'sendLoginOtp']);
Route::middleware('auth:api')->get('/v1/user/requests', [\App\Http\Controllers\Api\v1\Admin\RequestsController::class, 'userRequests']);
Route::middleware('auth:api')->get('/v1/requests', [\App\Http\Controllers\Api\v1\Admin\RequestsController::class, 'index']);
Route::middleware('auth:api')->post('/v1/requests/fail', [\App\Http\Controllers\Api\v1\Admin\RequestsController::class, 'fail']);
Route::middleware('auth:api')->post('/v1/requests/re-upload', [\App\Http\Controllers\Api\v1\Admin\RequestsController::class, 'reUploadMessage']);
Route::middleware('auth:api')->post('/v1/requests/payment-sent', [\App\Http\Controllers\Api\v1\Admin\RequestsController::class, 'paymentSent']);
Route::middleware('auth:api')->post('/v1/requests/approve', [\App\Http\Controllers\Api\v1\Admin\RequestsController::class, 'approve']);
Route::middleware('auth:api')->post('/v1/requests/complete', [\App\Http\Controllers\Api\v1\Admin\RequestsController::class, 'complete']);
Route::middleware('auth:api')->post('/v1/requests/accept-payment', [\App\Http\Controllers\Api\v1\Admin\RequestsController::class, 'acceptPayment']);
Route::middleware('auth:api')->post('/v1/requests/cancel', [\App\Http\Controllers\Api\v1\Admin\RequestsController::class, 'cancel']);
Route::middleware('auth:api')->post('/v1/requests/send-message', [\App\Http\Controllers\Api\v1\Admin\RequestsController::class, 'sendMessage']);
Route::middleware('auth:api')->get('/v1/categories', [\App\Http\Controllers\Api\v1\Admin\CategoriesController::class, 'index']);
Route::post('/v1/auth/login', [\App\Http\Controllers\Api\v1\Admin\AuthController::class, 'login']);
