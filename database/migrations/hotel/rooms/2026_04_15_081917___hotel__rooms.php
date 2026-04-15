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
        Schema::create('rooms', function (Blueprint $table) {
            $table->id();
            // Room type: Deluxe, Super deluxe, Exclusive
            $table->integer('type');
            // Which floor
            $table->integer('floor');
            $table->string('number');
            $table->string('main_group');

            // Room mode: Eco, Normal
            $table->integer('mode');

            // Room service status: Do not disturb; Make up Room; None
            $table->integer('rs_status')->default(0);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rooms');
    }
};
