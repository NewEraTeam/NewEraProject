<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserDataController;
use App\Http\Controllers\MainPageController;
use App\Http\Controllers\BadmintonController;
use App\Http\Controllers\SwimmingController;
use App\Http\Controllers\StadiumController;
use App\Http\Controllers\GymController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\ProfileController;


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
    return view('MainPageModule.MainPage');
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

// Customer booking history page
Route::get('/customer-booking', function(){
    return view('CustomerBookingModule.CustomerBooking'); // Corrected path for the customer-booking
})->name('customer-booking');

// About Us page
Route::get('/about-us', function () {
    return view('AboutUsModule.AboutUs'); // Corrected path for the About Us view
})->name('about-us');

Route::get('/view-mainpage', function(){
    return view('MainPageModule.MainPage');
})->name('view-mainpage');

//View Profile Page
Route::get('/view-profile', function(){
    return view('ViewProfileModule.ViewProfile');
})->name('view-profile');

Route::get('/bookingBadminton', [BookingController::class, 'showBookingBadminton'])->name('bookingBadminton');
Route::post('/submitBookingBadminton', [BookingController::class, 'submitBookingBadminton'])->name('submitBookingBadminton');
Route::get('/bookingPersonalDetails', [BookingController::class, 'showPersonalDetails'])->name('bookingPersonalDetails');
Route::post('/submitPersonalDetails', [BookingController::class, 'submitPersonalDetails'])->name('submitPersonalDetails');
Route::get('/bookingPayment', [BookingController::class, 'showPayment'])->name('bookingPayment');
Route::post('/submitPayment', [BookingController::class, 'submitPayment'])->name('submitPayment');
Route::get('/bookingSuccess', [BookingController::class, 'showSuccess'])->name('bookingSuccess');

//Localization Features
Route::get('/lang/{locale}', function ($locale) {
    // Validate the locale before setting it
    if (in_array($locale, ['en', 'bm', 'cn'])) {
        session(['locale' => $locale]);  // Store the selected language in the session
    }
    return redirect()->back();  // Redirect back to the previous page
});

Route::middleware(['auth'])->group(function () {
    Route::get('/booking-badminton', [BookingController::class, 'showBookingBadminton'])->name('bookingBadminton');
    Route::post('/booking-badminton', [BookingController::class, 'submitBookingBadminton']);
});
