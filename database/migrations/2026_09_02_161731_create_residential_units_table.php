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
        Schema::create('residential_units', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('residence_id');
            $table->string('unit_number');
            $table->timestamps();

            $table->unique(['residence_id', 'unit_number']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('residential_units');
    }
};
