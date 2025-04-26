<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Flight extends Model
{
    protected $fillable = [
        'flight_number',
        'departure_date',
        'arrival_date',
        'departure_time',
        'arrival_time',
        'aircraft_type',
        'services',
        'origin',
        'flight_coordinator_id',
        'gate_id',
    ];

    public function flightCoordinator()
    {
        return $this->belongsTo(Flight_Coordinator::class);
    }

    public function gate()
    {
        return $this->belongsTo(Gate::class);
    }
    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}
