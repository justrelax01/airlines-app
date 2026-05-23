<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\HotelBookingController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\PaymentController;

// Public pages
Route::get('/', fn() => view('pages.home'))->name('home');
Route::get('/flights', fn() => view('pages.flights'))->name('flights');
Route::get('/search-flights', fn() => view('pages.searchflights'))->name('searchflights');
Route::get('/bookhotel', fn() => view('pages.bookhotel'))->name('bookhotel');
Route::get('/faq', fn() => view('pages.faqandfeedb'))->name('faq-feedback');

// Auth routes
Route::get('/login', fn() => view('auth.login'))->name('login');
Route::get('/register', fn() => view('auth.register'))->name('register');
Route::post('/register', [RegisterController::class, 'submit'])->name('register.submit');
Route::post('/login', [LoginController::class, 'login'])->name('login.submit');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Form submission routes (accessible to guests and authenticated users)
Route::post('/bookhotel', [HotelBookingController::class, 'store'])->name('hotel.book');
Route::post('/feedback', [FeedbackController::class, 'store'])->name('feedback.store');

// Protected pages
Route::middleware(['auth'])->group(function () {

    // Payment page — now served by the controller so it can pass the booking to the view
    Route::get('/payment',  [PaymentController::class, 'index'])->name('payment.index');
    Route::post('/payment', [PaymentController::class, 'store'])->name('payment.store');

    // Cancel a booking
    Route::delete('/bookings/{id}', [PaymentController::class, 'destroy'])->name('booking.destroy');

    // Dashboard
    Route::get('/dashboard', function () {
        $bookings = auth()->user()
            ->bookings()
            ->with(['flight', 'payment'])
            ->latest()
            ->get();
        return view('dashboard', compact('bookings'));
    })->name('dashboard');

});