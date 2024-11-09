<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('login'); // Load the login page by default
})->name('login.page');

Route::get('/register', function () {
    return view('register'); // Load the register page
})->name('register.page');

Route::post('/login', [UserController::class, 'login'])->name('login.submit');

Route::get('/register', [UserController::class, 'showRegisterForm'])->name('register.page');
Route::post('/register', [UserController::class, 'register'])->name('register.submit');
Route::get('/login', [UserController::class, 'showLoginForm'])->name('login.page');
Route::post('/login', [UserController::class, 'login'])->name('login.submit');
Route::get('/register', function () {
    return view('register');
})->name('register.page');



