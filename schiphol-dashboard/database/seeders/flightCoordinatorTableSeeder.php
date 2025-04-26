<?php

namespace Database\Seeders;

use App\Models\Flight_Coordinator;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class FlightCoordinatorTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Flight_Coordinator::insert([
            ['director_id' => 1, 'name' => 'John Doe', 'username' => 'johndoe', 'password' => Hash::make('password123'), 'contact_info' => 'john.doe@example.com', 'created_at' => now(), 'updated_at' => now()],
            ['director_id' => 2, 'name' => 'Jane Smith', 'username' => 'janesmith', 'password' => Hash::make('securepass456'), 'contact_info' => 'jane.smith@example.com', 'created_at' => now(), 'updated_at' => now()],
            ['director_id' => 1, 'name' => 'Alice Johnson', 'username' => 'alicejohnson', 'password' => Hash::make('alicepass789'), 'contact_info' => 'alice.johnson@example.com', 'created_at' => now(), 'updated_at' => now()],
            ['director_id' => 2, 'name' => 'Bob Brown', 'username' => 'bobbrown', 'password' => Hash::make('bobbrown321'), 'contact_info' => 'bob.brown@example.com', 'created_at' => now(), 'updated_at' => now()],
            ['director_id' => 1, 'name' => 'Charlie Davis', 'username' => 'charliedavis', 'password' => Hash::make('charliepass654'), 'contact_info' => 'charlie.davis@example.com', 'created_at' => now(), 'updated_at' => now()],
            ['director_id' => 2, 'name' => 'Diana Evans', 'username' => 'dianaevans', 'password' => Hash::make('dianaevans987'), 'contact_info' => 'diana.evans@example.com', 'created_at' => now(), 'updated_at' => now()],
            ['director_id' => 1, 'name' => 'Ethan Foster', 'username' => 'ethanfoster', 'password' => Hash::make('ethanfoster123'), 'contact_info' => 'ethan.foster@example.com', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
