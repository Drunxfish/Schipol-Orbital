<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Mail\BookingCanceled;
use App\Mail\BookingConfirmed;
use Illuminate\Http\Request;
use App\Models\Flight;
use App\Models\Booking;
use App\Models\Traveler;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;

class BookingController extends Controller
{
    // Get flight data
    public function loadFlightData($flight_id)
    {
        $flight = Flight::findOrFail($flight_id);
        return view('bookings.process', compact('flight'));
    }

    // Store booking
    public function store(Request $request)
    {
        // Validate token
        if (!$request->query('token') || $request->query('token') !== session('booking_token') || session('booking_token_flight_id') != $request->flight_id) {
            abort(403, 'Link expired');
        }

        // Validate input
        try {
            $request->validate([
                'first_name'      => 'required|string|max:255',
                'last_name'       => 'required|string|max:255',
                'email'           => 'required|email|max:255',
                'address'         => 'required|string|max:255',
                'phone_number'    => 'required|string|max:20',
                'flight_id'       => 'required|integer|exists:flights,id',
                'seat_class'      => 'required|in:economy,business',
                'seat_preference' => 'nullable|string|max:50',
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput()->with('popup_message', 'Validation failed. Please check your input and try again.');
        }

        // Grab flight
        $flight = Flight::findOrFail($request->flight_id);

        // Check seat availability
        if ($flight->seats_booked >= $flight->seats_total) {
            return redirect()->back()->withInput()->with('popup_message', 'Sorry, no seats are available for this flight. Please select an alternative flight.');
        }

        // Determine ticket price
        $price = ($request->seat_class === 'business' && isset($flight->business_ticket_price)) ? $flight->business_ticket_price : $flight->ticket_price;

        try {
            DB::transaction(function () use ($request, $flight, $price, &$tracker) {
                // Find or create traveler
                $traveler = Traveler::firstOrCreate(
                    ['email' => $request->email],
                    [
                        'name'        => "$request->first_name $request->last_name",
                        'address'     => $request->address,
                        'phone_number' => $request->phone_number,
                    ]
                );

                // Create booking
                $booking = Booking::create([
                    'tracker' => bin2hex(random_bytes(32)),
                    'confirmation_token' => bin2hex(random_bytes(32)),
                    'traveler_id'    => $traveler->id,
                    'flight_id'      => $flight->id,
                    'seat_class'     => $request->seat_class,
                    'seat_preference' => $request->seat_preference,
                    'seat' => ucfirst(chr(65 + intval($flight->seats_booked / 6))) . (($flight->seats_booked % 6) + 1),
                    'total_cost'     => $price,
                    'booking_date'   => NOW(),
                ]);

                // Increment booked seats
                $flight->increment('seats_booked');
                $tracker = $booking->tracker;
            });

            // Prevent form reuse
            session()->forget(['booking_token', 'booking_token_flight_id']);

            # Booking created, sending email
            $booking = Booking::with(['traveler', 'flight'])->where('tracker', $tracker)->firstOrFail();

            // Generate a signed
            $signedUrl = URL::temporarySignedRoute(
                'bookings.display',
                \Carbon\Carbon::parse($booking->flight->departure_date)->addDays(2),
                ['tracker' => $booking->tracker, 'token' => $booking->confirmation_token]
            );

            // For the view access
            session(['bookingComplete' => true]);

            // Send the confirmation email
            Mail::to($booking->traveler->email)->send(new BookingConfirmed($signedUrl, $booking));

            return redirect()->route('bookings.confirmed');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('popup_message', 'Booking failed. Please try again');
        }
    }

    // Display booking
    public function show(Request $request, $tracker)
    {
        $booking = Booking::with(['traveler', 'flight'])->where('tracker', $tracker)->firstOrFail();


        if ($request->query('token') !== $booking->confirmation_token) {
            abort(403, 'Link expired');
        }

        if (!$booking) {
            abort(404); // Invalid token
        }

        return view('bookings.display', compact('booking'));
    }

    // Cancel booking
    public function cancel(Request $request, $tracker)
    {
        try {
            // Get the booking data
            $booking = Booking::with('traveler', 'flight')->where('tracker', $tracker)->firstOrFail();

            // No access
            if ($request->query('token') !== $booking->confirmation_token) {
                abort(403, 'Invalid link.');
            }

            // Already canceled
            if ($booking->status === 'canceled') {
                return redirect()->route('bookings.display', ['tracker' => $tracker, 'token' => $booking->confirmation_token])
                    ->with('popup_message', 'This booking has already been canceled.');
            }

            // Check if cancellation is allowed
            if (!$booking->flight) {
                return redirect()->route('bookings.display', ['tracker' => $tracker, 'token' => $booking->confirmation_token])
                    ->with('popup_message', 'Flight information is missing.');
            }

            // Make sure they meet requirement
            $departureDate = \Carbon\Carbon::parse($booking->flight->departure_date);
            if (now()->diffInDays($departureDate, false) < 2) {
                return redirect()->route('bookings.display', ['tracker' => $tracker, 'token' => $booking->confirmation_token])
                    ->with('popup_message', 'Bookings can only be canceled at least 2 days before departure.');
            }

            // Update data
            DB::transaction(function () use ($booking) {
                $booking->status = 'canceled';
                $booking->flight->decrement('seats_booked');
                $booking->save();
            });

            // Feedback + Email
            session(['booking_canceled' => true]);
            Mail::to($booking->traveler->email)->send(new BookingCanceled($booking));
            return redirect()->route('bookings.canceled');
        } catch (\Exception $e) {
            // Failed
            return redirect()->back()->with('popup_message', 'Cancellation failed. Please try again later.');
        }
    }
}
