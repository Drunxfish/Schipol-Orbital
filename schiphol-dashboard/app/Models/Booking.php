<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = [
        'tracker',
        'confirmation_token',
        'traveler_id',
        'flight_id',
        'seat_class',
        'seat_preference',
        'total_cost',
        'booking_date',
        'status',
    ];

    public function traveler()
    {
        return $this->belongsTo(Traveler::class);
    }

    public function flight()
    {
        return $this->belongsTo(Flight::class);
    }
}
