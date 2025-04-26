<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Flight_coordinator extends Model
{
    protected $fillable = [
        'director_id',
        'name',
        'username',
        'password',
        'contact_info',
    ];

    public function flights()
    {
        return $this->hasMany(Flight::class);
    }
}
