<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\TokenController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\CurrencyController;

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


//Resources
Route::middleware('auth:sanctum')->prefix('/country')->group(function(){
    Route::get('/', [CountryController::class, 'index']);
    Route::get('/create', [CountryController::class, 'create']);
    Route::post('/store', [CountryController::class, 'store']);
    Route::get('/show/{company}', [CountryController::class, 'show']);
    Route::get('/edit', [CountryController::class, 'edit']);
    Route::post('/update/{company}', [CountryController::class, 'update']);
    Route::get('/destroy/{company}', [CountryController::class, 'destroy']);
});
Route::middleware('auth:sanctum')->prefix('/currency')->group(function(){
    Route::get('/', [CurrencyController::class, 'index']);
    Route::get('/create', [CurrencyController::class, 'create']);
    Route::post('/store', [CurrencyController::class, 'store']);
    Route::get('/show/{company}', [CurrencyController::class, 'show']);
    Route::get('/edit', [CurrencyController::class, 'edit']);
    Route::post('/update/{company}', [CurrencyController::class, 'update']);
    Route::get('/destroy/{company}', [CurrencyController::class, 'destroy']);
});

// Company
Route::middleware('auth:sanctum')->prefix('/company')->group(function(){
    Route::get('/', [CompanyController::class, 'index']);
    Route::get('/create', [CompanyController::class, 'create']);
    Route::post('/store', [CompanyController::class, 'store']);
    Route::get('/show/{company}', [CompanyController::class, 'show']);
    Route::get('/edit', [CompanyController::class, 'edit']);
    Route::post('/update/{company}', [CompanyController::class, 'update']);
    Route::get('/destroy/{company}', [CompanyController::class, 'destroy']);
});