<?php

namespace Database\Seeders;

use App\Models\Traveler;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TravelerTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Traveler::insert([
            ['name' => 'Jan Jansen', 'address' => 'Kerkstraat 12', 'email' => 'janjansen@example.com', 'phone_number' => '0612345678', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Marie de Vries', 'address' => 'Dorpsstraat 34', 'email' => 'mariedevries@example.com', 'phone_number' => '0687654321', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
