<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TokenController;

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

// Welcome
Route::get('/', function () {
    return view('welcome');
})->name('welcome')->middleware('guest');
// Login
Route::get('/login', function () {
    return view('welcome');
})->name('login')->middleware('guest');
// token
Route::prefix('token')->group(function () {
    Route::middleware('auth:sanctum')->post('/create', [TokenController::class, 'create']);
    Route::middleware('auth:sanctum')->post('/list', [TokenController::class, 'list']);
});



// home
Route::get('/home', function () {
    return view('home');
})->name('home')->middleware('auth');
