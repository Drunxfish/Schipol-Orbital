<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Traveler extends Model
{
    // Unreachable outside of the class
    protected $fillable = [
        'name',
        'address',
        'email',
        'phone_number',
    ];
    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

}
