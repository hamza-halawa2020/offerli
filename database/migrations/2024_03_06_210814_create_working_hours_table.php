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
        Schema::create('working_hours', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('brand_id')->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->time('sun_ot')->nullable();
            $table->time('sun_ct')->nullable();
            $table->time('mon_ot')->nullable();
            $table->time('mon_ct')->nullable();
            $table->time('tue_ot')->nullable();
            $table->time('tue_ct')->nullable();
            $table->time('wed_ot')->nullable();
            $table->time('wed_ct')->nullable();
            $table->time('thu_ot')->nullable();
            $table->time('thu_ct')->nullable();
            $table->time('fri_ot')->nullable();
            $table->time('fri_ct')->nullable();
            $table->time('sat_ot')->nullable();
            $table->time('sat_ct')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('working_hours');
    }
};
