<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Create the travelers table
        Schema::create('bookings', function (Blueprint $table) {
            $table->id()->unique();
            $table->string('tracker')->unique();
            $table->foreignId('traveler_id')->constrained('travelers')->onDelete('cascade');
            $table->foreignId('flight_id')->constrained('flights')->onDelete('cascade');
            $table->enum('seat_class', ['economy', 'business', 'first']);
            $table->string('seat_preference')->nullable();
            $table->decimal('total_cost', 10, 2);
            $table->date('booking_date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Drop the bookings table
        Schema::dropIfExists('bookings');
    }
};
