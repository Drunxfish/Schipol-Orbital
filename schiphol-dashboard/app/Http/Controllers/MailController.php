<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Mail\BookingConfirmation;
use App\Mail\MailTester;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;

class MailController extends Controller
{
    public function sendBookingConfirmation(Request $request)
    {
        $token = bin2hex(random_bytes(32));
        $flightId = $request->flight_id;

        // Store token in session
        session([
            'booking_token' => $token,
            'booking_token_flight_id' => $flightId,
            'booking_confirmed' => true
        ]);

        // Generate signed link for safe access
        $signedUrl = URL::temporarySignedRoute(
            'bookings.finalize',
            now()->addMinutes(30),
            ['flight_id' => $flightId, 'token' => $token]
        );



        // Send email
        Mail::to($request->email)->send(new BookingConfirmation($signedUrl));

        return redirect()->route('bookings.confirmationSent');
    }
}
