<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [\App\Http\Controllers\HomeController::class, 'index']);
Route::get('/about', [\App\Http\Controllers\HomeController::class, 'about']);
Route::get('/jadval', [\App\Http\Controllers\HomeController::class, 'jadval']);
Route::get('/registration', [\App\Http\Controllers\HomeController::class, 'registration']);
Route::post('/conferences/create', [\App\Http\Controllers\RequestsController::class, 'store']);
Route::post('/conferences/re-upload', [\App\Http\Controllers\RequestsController::class, 'reUpload']);
Route::get('/change', [\App\Http\Controllers\RequestsController::class, 'reUpload']);
