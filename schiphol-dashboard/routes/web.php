<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FlightController;



Route::view('/', 'index')->name('index'); // Home page
Route::get('/flights', [FlightController::class, 'index'])->name('flights.index'); // Home page
Route::get('/flights/departure', [FlightController::class, 'departure'])->name('flights.departure');
Route::get('/flights/arrival', [FlightController::class, 'arrival'])->name('flights.arrival');
