<?php

namespace App\Http\Controllers;

use App\Models\Flight;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FlightController extends Controller
{
    // This method is for showing all flights
    public function index(Request $request)
    {
        $flights = Flight::orderBy('departure_date', 'asc')->orderBy('departure_time', 'asc')->get();
        return view('flights.index', compact('flights'));
    }

    // This method is for showing flights departing from Schiphol Orbital
    public function departure(Request $request)
    {
        $query = Flight::where('origin', '=', 'Schiphol Orbital');

        foreach (['destination' => 'destination', 'date' => 'departure_date'] as $input => $column) {
            if ($request->filled($input)) {
                $value = $request->input($input);
                $query->where($column, 'like', "%{$value}%");
            }
        }

        $flights = $query->orderBy('departure_date', 'asc')->orderBy('departure_time', 'asc')->get();

        return view('flights.departure', compact('flights'));
    }

    // Shows Departure details for a specific flight
    public function departureDetails($flightId)
    {
        $flight = Flight::findOrFail($flightId);
        return view('flights.departure-details', compact('flight'));
    }


    // This method is for showing flights arriving at Schiphol Orbital
    public function arrival(Request $request)
    {
        $query = Flight::where('origin', '!=', 'Schiphol Orbital');

        foreach (['origin' => 'origin', 'date' => 'arrival_date'] as $input => $inpVal) {
            if ($request->filled($input)) {
                $value = $request->input($input);
                $query->where($inpVal, 'like', "%{$value}%");
            }
        }


        $flights = $query->orderBy('arrival_time')->get();

        return view('flights.arrival', compact('flights'));
    }

    // Shows Arrival details for a specific flight
    public function arrivalDetails($flightId)
    {
        $flight = Flight::findOrFail($flightId);
        return view('flights.arrival-details', compact('flight'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
