<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\FactController;
use App\Http\Controllers\PeccController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\TokenController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\UploadController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CurrencyController;
use App\Http\Controllers\MembershipController;
use App\Http\Controllers\DateDimensionController;
use App\Http\Controllers\ExtractIncomeController;
use App\Http\Controllers\FormulaLanding;

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

// Auth
Route::post('/login', [AuthController::class, 'login']);
Route::get('/logout', [AuthController::class, 'logout']);
Route::middleware('auth:sanctum')->post('/password/set', [AuthController::class, 'set_password']);
// Password Reset
Route::post('/forgot-password', [AuthController::class, 'forgotPassword'])->middleware('guest')->name('password.email');
Route::post('/reset-password', [AuthController::class, 'resetPassword'])->middleware('guest')->name('password.update');

//Resources
Route::get('/country', [CountryController::class, 'index']);
Route::get('/currency', [CurrencyController::class, 'index']);
Route::get('/dates', [DateDimensionController::class, 'index']);
Route::prefix('/date')->group(function(){
    Route::get('/years', [DateDimensionController::class, 'years']);
    Route::get('/structure', [DateDimensionController::class, 'structure']);
});

// User
Route::middleware('auth:sanctum')->post('/sanctum/token', [TokenController::class, 'token']);
Route::middleware('auth:sanctum')->prefix('/user')->group(function(){
    Route::get('/', [UserController::class, 'index']);
    Route::get('/search/new/{company}', [UserController::class, 'search_new']);
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
    Route::post('/avatar/contact/{contact}', [UploadController::class, 'contactavatar']);
    Route::post('/avatar/pecc/{pecc}', [UploadController::class, 'peccavatar']);
});

// Pecc
Route::middleware('auth:sanctum')->prefix('/pecc')->group(function(){
    Route::get('/company/{id}', [PeccController::class, 'index']);
    Route::get('/trashed/{company}', [PeccController::class, 'trashed']);
    Route::get('/show/{pecc}', [PeccController::class, 'show']);
    Route::post('/store', [PeccController::class, 'store']);
    Route::put('/update/{pecc}', [PeccController::class, 'update']);
    Route::get('/destroy/{pecc}', [PeccController::class, 'destroy']);
    Route::get('/restore/{pecc}', [PeccController::class, 'restore']);
    Route::delete('/destroy/{id}', [PeccController::class, 'destroy_forever']);
});

// Contacts
Route::middleware('auth:sanctum')->prefix('/contact')->group(function(){
    Route::get('/company/{id}', [ContactController::class, 'index']);
    Route::get('/trashed', [ContactController::class, 'trashed']);
    Route::get('/show/{contact}', [ContactController::class, 'show']);
    Route::post('/store', [ContactController::class, 'store']);
    Route::put('/update/{contact}', [ContactController::class, 'update']);
    Route::get('/destroy/{contact}', [ContactController::class, 'destroy']);
    Route::get('/restore/{contact}', [ContactController::class, 'restore']);
    Route::delete('/destroy/{id}', [ContactController::class, 'destroy_forever']);
});




// Financial Routes
// Group
Route::middleware('auth:sanctum')->prefix('/group')->group(function(){
    Route::get('/', [GroupController::class, 'index']);
});

// Category
Route::middleware('auth:sanctum')->prefix('/category')->group(function(){
    Route::get('/show/{id}', [CategoryController::class, 'show']);
    Route::post('/store', [CategoryController::class, 'store']);
    Route::post('/sort', [CategoryController::class, 'sort']);
    Route::put('/update/{category}', [CategoryController::class, 'update']);
    Route::delete('/destroy/{id}', [CategoryController::class, 'destroy']);
    Route::get('/{company}/all', [CategoryController::class, 'index']);
    Route::get('/{company}/grouped', [CategoryController::class, 'grouped']);
    Route::get('/{company}/group/{type}', [CategoryController::class, 'groups']);
    Route::get('/{company}/parentable', [CategoryController::class, 'parentable']);
    Route::get('/{company}/leaves/{type}', [CategoryController::class, 'leaves']);
    Route::get('/{company}/{type}/{tree?}', [CategoryController::class, 'tree']);
    Route::get('/{company}/accounts', [CategoryController::class, 'accounts']);
    Route::get('/report/{company}/{type}/{year}/{depth}', [CategoryController::class, 'report']);
});

// Fact
Route::middleware('auth:sanctum')->prefix('/fact')->group(function(){
    Route::get('/{company}', [FactController::class, 'index']);
    Route::get('/set/{company}', [FactController::class, 'set']);
    Route::get('/show/{fact}', [FactController::class, 'show']);
    Route::get('/edit/{company}/{type}/{year}/{section}', [FactController::class, 'edit']);
    Route::post('/store', [FactController::class, 'store']);
    Route::put('/update/{fact}', [FactController::class, 'update']);
    Route::delete('/destroy/{id}', [FactController::class, 'destroy']);
});

// Report
Route::middleware('auth:sanctum')->prefix('/report')->group(function(){
    Route::get('/{company}/{type}/{year}/{section}/{level}', [ReportController::class, 'report']);
});


// Extract
Route::middleware('auth:sanctum')->prefix('/extract')->group(function(){
    Route::get('/{company}/{type}/{year}/{section}', [ExtractIncomeController::class, 'index']);
});
// Formula
Route::middleware('auth:sanctum')->prefix('/formula')->group(function(){
    Route::get('/{company}/get', [FormulaLanding::class, 'get']);
    Route::get('/{company}/ebit/{year}/{section}', [FormulaLanding::class, 'ebit']);
    Route::get('/{company}/ratio/{year}/{section}', [FormulaLanding::class, 'ratio']);
    Route::post('/store', [FormulaLanding::class, 'store']);
});





// Template
Route::middleware('auth:sanctum')->prefix('/model')->group(function(){
    Route::get('', [TestController::class, 'index']);
    Route::get('/show/{contact}', [TestController::class, 'show']);
    Route::post('/store', [TestController::class, 'store']);
    Route::put('/update/{contact}', [TestController::class, 'update']);
    Route::delete('/destroy/{id}', [TestController::class, 'destroy']);
});