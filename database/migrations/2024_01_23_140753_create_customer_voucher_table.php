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
        Schema::create('customer_voucher', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('voucher_id')->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('payment_id')->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('status_id')->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('branch_id')->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->decimal('paid_price', 8, 2);
            // $table->decimal('profit', 8, 2);
            // $table->decimal('tax', 8, 2);
            $table->timestamp('expire_at')->nullable();
            $table->foreignId('invoice_id')->onDelete('set null')->nullable();
            $table->string('code')->unique()->nullable();
            // $table->boolean("invoiced")->default(0);
            // $table->boolean("claimed")->default(0);
            $table->integer("rating")->nullable();
            $table->longText("rating_comment")->nullable();
            $table->softDeletes();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customer_voucher');
    }
};
