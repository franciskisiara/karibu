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
        Schema::create('visits', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('occupancy_id');
            $table->unsignedBigInteger('visitor_id');
            $table->string('passcode');
            $table->timestamp('welcomed_at')->nullable();
            $table->timestamps();

            $table->foreign('occupancy_id')->references('id')->on('occupancies')->cascadeOnDelete();
            $table->foreign('visitor_id')->references('id')->on('users')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('visits');
    }
};
