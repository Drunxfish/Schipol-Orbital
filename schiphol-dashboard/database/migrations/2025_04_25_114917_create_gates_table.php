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
        // Create the gate table
        Schema::create('gates', function (Blueprint $table) {
            $table->id()->bigIncrements()->unique();
            $table->string('type');
            $table->string('location');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Drop the gate table
        Schema::dropIfExists('gates');
    }
};
