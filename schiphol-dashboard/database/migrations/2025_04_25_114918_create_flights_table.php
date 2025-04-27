<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Validation\Rules\Unique;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Create the flight table
        Schema::create('flights', function (Blueprint $table) {
            $table->id();

            // Flight Information
            $table->string('flight_number')->unique(); // Tracking number
            $table->date('departure_date');
            $table->date('arrival_date');
            $table->time('departure_time');
            $table->time('arrival_time');
            $table->string('aircraft_type');
            $table->string('airline');
            $table->enum('status', ['Scheduled', 'Delayed', 'Cancelled', 'Departed', 'Arrived'])->default('Scheduled');
            $table->string('check_in_location')->nullable();
            $table->decimal('ticket_price', 10, 2)->nullable();
            $table->enum('ticket_status', ['Available', 'Sold Out', 'Cancelled'])->default('Available');

            // Additional Details
            $table->text('services')->nullable();
            $table->string('origin'); // *Departure location // Tracking 
            $table->string('destination'); // *Arrival location // Tracking

            // Seat Information
            $table->integer('seats_total');
            $table->integer('seats_booked')->default(0);

            // Foreign Keys
            $table->foreignId('flight_coordinator_id')->constrained('flight_coordinators')->onDelete('cascade');
            $table->foreignId('gate_id')->constrained('gates')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Drop the flight table
        Schema::dropIfExists('flights');
    }
};
