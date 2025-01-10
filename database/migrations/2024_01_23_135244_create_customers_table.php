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
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('name_ar')->nullable();
            $table->string('slug');
            $table->string('email')->unique();
            $table->string('phone')->unique();
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();
            $table->decimal('wallet', 8, 2)->default(0);
            $table->string('password');
            $table->longText("device_token")->nullable();
            $table->boolean("blocked")->default(0);
            $table->timestamp('blocked_until')->nullable();
            $table->string('picture')->default('default.png');
            $table->date('last_login')->nullable();
            $table->string('address')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
