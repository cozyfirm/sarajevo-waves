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
        Schema::create('rooms__lights', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('room_id');
            $table->foreign('room_id')
                ->references('id')
                ->on('rooms')
                ->onDelete('cascade');

            // Switch or dali (dimmer)
            $table->string('type', 20)->default('switch');

            $table->string('title');
            $table->string('group_address');
            $table->tinyInteger('status')->default(0);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rooms__lights');
    }
};
