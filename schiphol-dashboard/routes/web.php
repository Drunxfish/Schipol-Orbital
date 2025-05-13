<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FlightController;
use App\Http\Controllers\MailController;

# Departure
Route::view('/', 'index')->name('index'); // Home page
Route::get('/flights', [FlightController::class, 'index'])->name('flights.index'); // Home page
Route::get('/flights/departure', [FlightController::class, 'departure'])->name('flights.departure');
Route::get('/flights/departure/{flight}', [FlightController::class, 'departureDetails'])->name('flights.departure.flight');

# Arrival
Route::get('/flights/arrival', [FlightController::class, 'arrival'])->name('flights.arrival');
Route::get('/flights/arrival/{flight}', [FlightController::class, 'arrivalDetails'])->name('flights.arrival.flight');

# Mail
Route::get('/test', [MailController::class, 'sendMail'])->name('bookings.signUp');