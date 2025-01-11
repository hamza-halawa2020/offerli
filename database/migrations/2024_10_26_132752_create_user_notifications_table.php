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
        Schema::create('user_notifications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->nullable()->constrained('customers')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('brand_id')->constrained('brands')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('voucher_id')->nullable()->constrained('vouchers')->cascadeOnUpdate()->cascadeOnDelete();
            $table->string('image')->nullable();
            $table->string('title');
            $table->text('description');
            $table->enum('status', ['sent', 'delivered', 'read'])->default('sent');
            $table->timestamp('read_at')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_notifications');
    }
};
