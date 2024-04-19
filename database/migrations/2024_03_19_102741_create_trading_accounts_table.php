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
        Schema::create('trading_accounts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('trading_group_id')->nullable()->constrained()->onDelete('cascade');
            $table->foreignId('brand_id')->references('id')->on('brands')->onDelete('cascade');
            $table->string('public_key')->nullable();
            $table->string('login_id')->nullable();
            $table->string('password')->nullable();
            $table->string('country')->nullable();
            $table->string('name')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->string('leverage')->nullable();
            $table->string('balance')->default('0');
            $table->string('credit')->default('0');
            $table->string('equity')->nullable();
            $table->string('margin_level_percentage')->default('0');
            $table->string('profit')->default('0');
            $table->string('swap')->nullable();
            $table->string('currency')->nullable();
            $table->string('registration_time')->nullable();
            $table->string('last_access_time')->nullable();
            $table->string('last_access_address_IP')->nullable();
            $table->string('status')->default('active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trading_accounts');
    }
};
