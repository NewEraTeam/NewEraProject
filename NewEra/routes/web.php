<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\UserDataController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainPageController;
use App\Http\Controllers\BadmintonController;
use App\Http\Controllers\SwimmingController;
use App\Http\Controllers\StadiumController;
use App\Http\Controllers\GymController;

// Default route to load the login page
Route::get('/', [UserDataController::class, 'showLogin'])->name('login.page');

// Show login page
Route::get('/login', [UserDataController::class, 'showLogin'])->name('login.page');

// Handle login form submission
Route::post('/login', [UserDataController::class, 'login'])->name('login.submit');

// Show register page
Route::get('/register', [UserDataController::class, 'showForm'])->name('register.page');

// Handle registration form submission
Route::post('/register', [UserController::class, 'register'])->name('register.submit');

Route::get('/mainpage', [MainPageController::class, 'index'])->name('mainpage');

// Route to Main Page (once logged in)
Route::get('/MainPageModule', function () {
    return view('MainPage');
})->name('MainPage.page');

// Redirect button from login page to register page (New User Signup)
Route::get('/register', function () {
    return view('register'); // Load register.blade.php
})->name('register.page');


// Facility Pages
Route::get('/facility/badminton', function () {
    return view('badminton'); // Ensure this view exists
})->name('facility.badminton');

Route::get('/facility/badminton', [BadmintonController::class, 'index'])->name('badminton');

Route::get('/facility/swimming', function () {
    return view('swimming'); // Ensure this view exists
})->name('facility.swimming');

Route::get('/facility/swimming', [SwimmingController::class, 'index'])->name('swimming');

Route::get('/facility/stadium', function () {
    return view('stadium'); // Ensure this view exists
})->name('facility.stadium');

Route::get('/facility/stadium', [StadiumController::class, 'index'])->name('stadium');

Route::get('/facility/gym', function () {
    return view('gym'); // Ensure this view exists
})->name('facility.gym');

Route::get('/facility/gym', [GymController::class, 'index'])->name('gym');
