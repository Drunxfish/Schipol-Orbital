<?php

namespace Database\Seeders;
use App\Models\Director;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DirectorTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Director::insert([
            ['name' => 'John Doe', 'username' => 'johndoe', 'password' => Hash::make('password123'), 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Bob Brown', 'username' => 'bobbrown', 'password' => Hash::make('password123'), 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
