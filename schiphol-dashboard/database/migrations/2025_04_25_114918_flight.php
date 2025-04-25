<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Validation\Rules\Unique;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Create the flight table
        Schema::create('flights', function (Blueprint $table) {
            $table->id()->bigIncrements()->unique();
            $table->string('flight_number')->unique();
            $table->date('departure_date');
            $table->date('arrival_date');	
            $table->time('departure_time');
            $table->time('arrival_time');
            $table->string('aircraft_type');
            $table->text('services');
            $table->string('origin');
            $table->foreignId('flight_coordinator_id')->constrained('flight_coordinators')->onDelete('cascade');
            $table->foreignId('gates')->constrained('gates')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
