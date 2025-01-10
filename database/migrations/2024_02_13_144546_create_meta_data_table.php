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
        Schema::create('meta_data', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('name_ar')->nullable();
            $table->string('address')->nullable();
            $table->string('email')->nullable();
            $table->decimal('bank_commission')->nullable();
            $table->text('vat_no')->nullable();
            $table->text('Com_Reg_No')->nullable();
            $table->text('IOS_Link')->nullable();
            $table->text('Android_Link')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('meta_data');
    }
};
