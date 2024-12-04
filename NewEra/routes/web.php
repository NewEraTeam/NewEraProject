<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\UserDataController;
use App\Http\Controllers\MainPageController;
use App\Http\Controllers\BadmintonController;
use App\Http\Controllers\SwimmingController;
use App\Http\Controllers\StadiumController;
use App\Http\Controllers\GymController;
use App\Http\Controllers\CustomerBookingController;
use Illuminate\Support\Facades\Route;

// Default route to load the login page
Route::get('/', [UserDataController::class, 'showLogin'])->name('login.page');

// Login routes
Route::get('/login', function () {
    return view('MainPageModule.login'); // Corrected path for the login view
})->name('login.page');
Route::post('/login', [UserDataController::class, 'login'])->name('login.submit');

// Registration routes
Route::get('/register', function () {
    return view('MainPageModule.register'); // Corrected path for the register view
})->name('register.page');
Route::post('/register', [UserController::class, 'register'])->name('register.submit');

// Main Page routes
Route::get('/mainpage', [MainPageController::class, 'index'])->name('mainpage');
Route::get('/MainPageModule', function () {
    return view('MainPageModule.MainPage'); // Corrected path for the Main Page view
})->name('MainPage.page'); // Alias for compatibility

// Facility routes
Route::get('/facility/badminton', [BadmintonController::class, 'index'])->name('badminton');
Route::get('/facility/swimming', [SwimmingController::class, 'index'])->name('swimming');
Route::get('/facility/stadium', [StadiumController::class, 'index'])->name('stadium');
Route::get('/facility/gym', [GymController::class, 'index'])->name('gym');

// Customer booking page
Route::get('/customer-booking', [CustomerBookingController::class, 'index'])->name('customer.booking');

// About Us page
Route::get('/about-us', function () {
    return view('AboutUsModule.AboutUs'); // Corrected path for the About Us view
})->name('about-us');

//View Profile Page
Route::get('/view-profile', function(){
    return view('ViewProfileModule.ViewProfile');
})->name('view-profile');