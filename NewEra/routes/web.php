<?php

use App\Http\Controllers\UserDataController;
use Illuminate\Support\Facades\Route;

// Display the login page
Route::get('/', [UserDataController::class, 'showLogin'])->name('login.page');

// Handle login submission (this will not check for a database in this example)
Route::post('/login', [UserDataController::class, 'login'])->name('login.submit');

// Display the signup form (second page)
Route::get('/signup', [UserDataController::class, 'showForm'])->name('signup.page');

// Handle form submission (sign up)
Route::post('/submit', [UserDataController::class, 'store'])->name('form.submit');

// Display the search page
Route::get('/search', [UserDataController::class, 'showSearch'])->name('search.page');

// Handle search request
Route::post('/search', [UserDataController::class, 'search'])->name('search.result');


