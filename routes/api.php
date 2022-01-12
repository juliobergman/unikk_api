<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\TokenController;

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

Route::post('/login', [LoginController::class, 'login']);
Route::middleware('auth:sanctum')->get('/user/auth', [TokenController::class, 'auth']);
Route::middleware('auth:sanctum')->post('/sanctum/token', [TokenController::class, 'token']);
Route::middleware('auth:sanctum')->get('/user', [UserController::class, 'index']);
