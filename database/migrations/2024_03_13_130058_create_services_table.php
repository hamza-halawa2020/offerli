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
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('name_ar');
            $table->string('name_en');
            $table->string('mainImage');
            $table->text('description');
            $table->decimal('priceBeforeDiscount', 8, 2);
            $table->decimal('discount', 8, 2)->nullable();
            $table->decimal('priceAfterDiscount', 8, 2);
            $table->string('mainAddress');
            $table->string('highlight');
            $table->boolean('reserve');
            $table->foreignId('sub_category_id')->constrained('subcategories')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('brand_id')->constrained('brands')->cascadeOnUpdate()->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('services');
    }
};
