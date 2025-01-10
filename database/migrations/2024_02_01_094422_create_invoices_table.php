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
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreignId('branch_id')->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->string('invoice_number')->unique();
            $table->decimal('total_vouchers', 8, 2)->nullable();

            $table->integer('credit_orders')->nullable();
            $table->decimal('credit_total', 8, 2)->nullable();
            $table->integer('cash_orders')->nullable();
            $table->decimal('cash_total', 8, 2)->nullable();
            $table->boolean('paid')->default(0);

            $table->decimal('total_invoice', 8, 2)->nullable();
            // $table->decimal('visa_price', 8, 2)->nullable();

            // $table->decimal('total_price', 8, 2)->nullable();

            // $table->decimal('tax', 8, 2)->nullable();
            // $table->decimal('profit', 8, 2)->nullable();
            $table->decimal('bank_commission', 8, 2)->nullable();
            $table->decimal('offerli_commission', 8, 2)->nullable();
            $table->decimal('other_fees', 8, 2)->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};
