<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Flight;
use App\Models\Booking;
use App\Models\Traveler;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

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
            abort(403, 'Invalid or expired booking token.');
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
                    'tracker'        => bin2hex(random_bytes(16)),
                    'traveler_id'    => $traveler->id,
                    'flight_id'      => $flight->id,
                    'seat_class'     => $request->seat_class,
                    'seat_preference' => $request->seat_preference,
                    'total_cost'     => $price,
                    'booking_date'   => NOW(),
                ]);

                // Increment booked seats
                $flight->increment('seats_booked');
                $tracker = $booking->tracker;
            });

            // Prevent form reuse
            session()->forget(['booking_token', 'booking_token_flight_id']);
            return redirect()->route('bookings.display', ['tracker' => $tracker]);
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('popup_message', 'Booking failed. Please try again.');
        }
    }

    // Display booking
    public function show($tracker)
    {
        $booking = Booking::with(['traveler', 'flight'])->where('tracker', $tracker)->firstOrFail();
        return view('bookings.display', compact('booking'));
    }
}
