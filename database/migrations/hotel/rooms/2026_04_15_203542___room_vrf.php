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
        Schema::create('rooms__vrfs', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('room_id');
            $table->foreign('room_id')
                ->references('id')
                ->on('rooms')
                ->onDelete('cascade');

            // Device address
            $table->string('source_address');

            //
            $table->string('status');
            $table->string('temperature');
            $table->string('fan_speed');
            $table->string('ambient_temperature');
            $table->string('alarm');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rooms__vrfs');
    }
};
