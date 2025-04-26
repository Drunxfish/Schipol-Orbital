<?php

namespace Database\Seeders;

use App\Models\Gate;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GateTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Gate::insert(
            [
                ['type' => 'Passenger', 'location' => 'Terminal 1 - Gate A1', 'created_at' => now(), 'updated_at' => now()],
                ['type' => 'Passenger', 'location' => 'Terminal 1 - Gate A2', 'created_at' => now(), 'updated_at' => now()],
                ['type' => 'Passenger', 'location' => 'Terminal 2 - Gate B1', 'created_at' => now(), 'updated_at' => now()],
                ['type' => 'Passenger', 'location' => 'Terminal 2 - Gate B2', 'created_at' => now(), 'updated_at' => now()],
                ['type' => 'Cargo', 'location' => 'Cargo Terminal - Gate C1', 'created_at' => now(), 'updated_at' => now()],
                ['type' => 'Cargo', 'location' => 'Cargo Terminal - Gate C2', 'created_at' => now(), 'updated_at' => now()],
                ['type' => 'Private', 'location' => 'Private Terminal - Gate D1', 'created_at' => now(), 'updated_at' => now()],
                ['type' => 'Private', 'location' => 'Private Terminal - Gate D2', 'created_at' => now(), 'updated_at' => now()],
            ]
        );
    }
}
