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

// Welcome
Route::get('/', function () {
    return view('welcome');
})->name('welcome')->middleware('guest');
// Login
Route::get('/login', function () {
    return view('welcome');
})->name('login')->middleware('guest');



// Authenticated
Route::get('/authenticated', function () {
    return view('logged');
})->name('authenticated')->middleware('auth');
