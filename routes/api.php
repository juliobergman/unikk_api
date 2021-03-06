<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\TokenController;
use App\Http\Controllers\UploadController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\CurrencyController;
use App\Http\Controllers\MembershipController;

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

// Login
Route::post('/login', [LoginController::class, 'login']);

//Resources
Route::prefix('/country')->group(function(){
    Route::get('/', [CountryController::class, 'index']);
});
Route::middleware('auth:sanctum')->prefix('/currency')->group(function(){
    Route::get('/', [CurrencyController::class, 'index']);
});

// User
Route::middleware('auth:sanctum')->post('/sanctum/token', [TokenController::class, 'token']);
Route::middleware('auth:sanctum')->prefix('/user')->group(function(){
    Route::get('/', [UserController::class, 'index']);
    Route::get('/search/new/{company}', [UserController::class, 'search_new']);
    Route::get('/auth', [TokenController::class, 'auth']);
    Route::get('/show/{user}', [UserController::class, 'show']);
    Route::post('/store', [UserController::class, 'store']);
    Route::put('/update/{user}', [UserController::class, 'update']);
    Route::get('/destroy/{user}', [UserController::class, 'destroy']);

    Route::put('/new-account', [UserController::class, 'new_account']);
    Route::get('/select/{user}', [UserController::class, 'select']);
});

// Company
// Route::get('/company/show/{company}', [CompanyController::class, 'show']);
Route::middleware('auth:sanctum')->prefix('/company')->group(function(){
    Route::get('/{company}/type/{type?}', [CompanyController::class, 'index']);
    Route::get('/show/{company}/{type?}', [CompanyController::class, 'show']);
    // Route::get('/show/{company}/type/{type?}', [CompanyController::class, 'show']);
    Route::post('/store', [CompanyController::class, 'store']);
    Route::post('/create', [CompanyController::class, 'create']);
    Route::get('/edit', [CompanyController::class, 'edit']);
    Route::post('/update/{company}', [CompanyController::class, 'update']);
    Route::get('/destroy/{company}', [CompanyController::class, 'destroy']);
});

// Memberships
Route::middleware('auth:sanctum')->prefix('/membership')->group(function(){
    Route::get('/', [MembershipController::class, 'index']);
    Route::get('/user', [MembershipController::class, 'user']);
    Route::get('/search/invitations/{company}', [MembershipController::class, 'invitations']);
    Route::get('/search/deleted/{company}', [MembershipController::class, 'deleted']);
    Route::put('/set/{membership}', [MembershipController::class, 'set']);
    Route::post('/store', [MembershipController::class, 'store']);
    Route::put('/update/{membership}', [MembershipController::class, 'update']);
    Route::get('/destroy/{membership}', [MembershipController::class, 'destroy']);
    Route::get('/restore/{id}', [MembershipController::class, 'restore']);
    Route::delete('/destroy/{id}', [MembershipController::class, 'destroy_forever']);
    // ---------------------------------------------------------------
    Route::get('/create', [MembershipController::class, 'create']);
    Route::get('/show/{membership}', [MembershipController::class, 'show']);
});


// Uploads
Route::middleware('auth:sanctum')->prefix('/upload')->group(function(){
    Route::post('/avatar/user', [UploadController::class, 'useravatar']);
    Route::post('/avatar/company/{company}', [UploadController::class, 'companyavatar']);
});