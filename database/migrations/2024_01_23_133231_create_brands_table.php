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
        Schema::create('brands', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('name_ar')->nullable();
            $table->string('slug');
            $table->string('email')->unique();
            $table->string('phone')->nullable();
            $table->decimal('percentage', 8, 2)->default(0);
            $table->decimal('other_fee', 8, 2)->default(0);
            $table->text('description')->nullable();
            $table->string('address')->nullable();
            $table->text('vat_no')->nullable();
            $table->text('Com_Reg_No')->nullable();
            $table->string('password');
            $table->boolean('active')->default(0);
            $table->longText("device_token")->nullable();
            $table->boolean("featured")->default(0);
            $table->timestamp('featured_until')->nullable();
            $table->string('logo')->default('default.png');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('brands');
    }
};
