<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gate extends Model
{
    protected $fillable = [
        'type',
        'location',
    ];
    
    public function flights()
    {
        return $this->hasMany(Flight::class);
    }
}
