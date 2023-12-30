<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RegisterController;

Route::get('/', [HomeController::class, 'index'])->name('index');

// Login
Route::get('/login', 'AuthController@showLoginForm')->name('login');
Route::post('/login', 'AuthController@login');

// Register
Route::get('/register', 'AuthController@showRegistrationForm')->name('register');
Route::post('/register', 'AuthController@register');

// use App\Http\Controllers\YourController;

Route::post('/process', [HomeController::class, 'process'])->name('process');
Route::post('/logout', [HomeController::class, 'logout'])->name('logout');


