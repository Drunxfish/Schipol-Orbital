<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Create the flight_coordinator table
        Schema::create('flight_coordinators', function (Blueprint $table) {
            $table->id();
            $table->foreignId('director_id')->constrained('directors')->onDelete('cascade');
            $table->string('name');
            $table->string('username')->unique();
            $table->string('password');
            $table->text('contact_info');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Drop the flight_coordinator table
        Schema::dropIfExists('flight_coordinator');
    }
};
