<?php

namespace Database\Seeders;

use App\Models\Booking;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BookingTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // ['name' => 'Jan Jansen', 'address' => 'Kerkstraat 12', 'email' => 'janjansen@example.com', 'phone_number' => '0612345678'],
        // ['name' => 'Marie de Vries', 'address' => 'Dorpsstraat 34', 'email' => 'mariedevries@example.com', 'phone_number' => '0687654321'],
        Booking::insert([
            ['traveler_id' => 1, 'flight_id' => 1, 'seat_class' => 'economy', 'seat_preference' => 'window', 'total_cost' => 250.00, 'booking_date' => '2023-09-25', 'tracker' => bin2hex(random_bytes(16)), 'created_at' => now(), 'updated_at' => now()],
            ['traveler_id' => 2, 'flight_id' => 2, 'seat_class' => 'business', 'seat_preference' => 'aisle', 'total_cost' => 750.00, 'booking_date' => '2023-09-30', 'tracker' => bin2hex(random_bytes(16)), 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
