<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;

// Public pages
Route::get('/home', fn() => view('pages.home'))->name('home');
Route::get('/flights', fn() => view('pages.flights'))->name('flights');
Route::get('/search-flights', fn() => view('pages.searchflights'))->name('searchflights');
Route::get('/bookhotel', fn() => view('pages.bookhotel'))->name('bookhotel');
Route::get('/payment', fn() => view('pages.payment'))->name('payment');
Route::get('/faq', fn() => view('pages.faqandfeedb'))->name('faq-feedback');

// Auth routes
Route::get('/login', fn() => view('auth.login'))->name('login');
Route::get('/register', fn() => view('auth.register'))->name('register');
Route::post('/register', [RegisterController::class, 'submit'])->name('register.submit');
Route::post('/login', [LoginController::class, 'submit'])->name('login.submit');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Protected pages
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', fn() => view('dashboard'))->name('dashboard');
});