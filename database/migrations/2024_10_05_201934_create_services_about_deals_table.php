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
        Schema::create('services_about_deals', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('answer');
            $table->string('question');
            $table->foreignId('service_id')->constrained('services')->cascadeOnUpdate()->cascadeOnDelete();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('services_about_deals');
    }
};
