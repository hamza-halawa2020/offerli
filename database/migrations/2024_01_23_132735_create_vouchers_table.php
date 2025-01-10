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
        Schema::create('vouchers', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->string('code')->unique()->nullable();
            $table->string('slug');
            $table->text('description')->nullable();
            $table->decimal('price', 8, 2);
            $table->decimal('discount', 8, 2);
            $table->boolean('active')->default(0);
            $table->boolean('singleUse')->default(0);
            $table->timestamp('expire_at')->nullable();
            $table->timestamp('start_at')->nullable();
            $table->integer('limit')->default(500);
            $table->unsignedBigInteger('brand_id')->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->unsignedBigInteger('subcategory_id')->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('payment_id')->onDelete('set null')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vouchers');
    }
};
