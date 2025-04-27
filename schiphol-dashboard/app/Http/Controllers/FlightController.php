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

        if ($request->filled('destination')) {
            $destination = $request->input('destination');
            $query->where('destination', 'like', "%{$destination}%");
        }

        $flights = $query->orderBy('departure_date', 'asc')->orderBy('departure_time', 'asc')->get();

        return view('flights.departure', compact('flights'));
    }

    // This method is for showing flights arriving at Schiphol Orbital
    public function arrival(Request $request)
    {
        $query = Flight::where('origin', '!=', 'Schiphol Orbital');

        if ($request->filled('origin')) {
            $origin = $request->input('origin');
            $query->where('origin', 'like', "%{$origin}%");
        }

        $flights = $query->orderBy('arrival_time')->get();

        return view('flights.arrival', compact('flights'));
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
     * Display the specified resource.
     */
    public function show(string $id)
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
