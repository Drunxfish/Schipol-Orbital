<?php

use App\Http\Controllers\BookingController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FlightController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\PdfController;
use App\Http\Controllers\ReportController;


# Display departure flight(s)
Route::view('/', 'index')->name('index'); // Home page
Route::get('/flights', [FlightController::class, 'index'])->name('flights.index'); // Home page
Route::get('/flights/departure', [FlightController::class, 'departure'])->name('flights.departure');
Route::get('/flights/departure/{flight}', [FlightController::class, 'departureDetails'])->name('flights.departure.flight');

# Display arrival flight(s)
Route::get('/flights/arrival', [FlightController::class, 'arrival'])->name('flights.arrival');
Route::get('/flights/arrival/{flight}', [FlightController::class, 'arrivalDetails'])->name('flights.arrival.flight');

# Booking
Route::get('/bookings/finalize/{flight_id}', [BookingController::class, 'loadFlightData'])
    ->name('bookings.finalize')
    ->middleware('signed'); # Display booking form view (inaccessable without token)
Route::post('/bookings/finalize/{flight_id}', [BookingController::class, 'store'])->name('bookings.store'); // Creates booking
Route::get('/bookings/display/{tracker}', [BookingController::class, 'show'])
    ->name('bookings.display')
    ->middleware('signed'); # Displays booking
Route::post('/bookings/cancel/{tracker}', [BookingController::class, 'cancel'])
    ->name('bookings.cancel')
    ->middleware('signed');



# Email
Route::post('/bookings/confirmation', [MailController::class, 'sendBookingConfirmation'])->name('bookings.confirmation'); # Sends email


# Confirmation views
Route::get('/bookings/confirmation-sent', function () {
    abort_unless(session('booking_confirmed'), 403);
    session()->forget('booking_confirmed');
    return view('information.confirmationSent');
})->name('bookings.confirmationSent'); # Displays booking (email) confirmation view
Route::get('/bookings/confirmed', function () {
    abort_unless(session('bookingComplete'), 403);
    session()->forget('bookingComplete');
    return view('information.confirmed');
})->name('bookings.confirmed'); # Booking confirmed view
Route::get('/bookings/canceled', function () {
    abort_unless(session('booking_canceled'), 403);
    session()->forget('booking_canceled');
    return view('information.canceled');
})->name('bookings.canceled'); # Booking canceled view



# PDF 
Route::get('/download-report/{tracker}/{token}', [PdfController::class, 'buildPDF'])
    ->name('download.report')
    ->middleware('signed');
