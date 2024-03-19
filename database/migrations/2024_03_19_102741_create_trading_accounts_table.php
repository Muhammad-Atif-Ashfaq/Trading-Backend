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
            $table->foreignId('user_id')->constrained()->onDelete('cascade')->nullable();
            $table->foreignId('trading_account_group_id')->constrained()->onDelete('cascade')->nullable();
            $table->string('public_key')->nullable();
            $table->string('login_id')->nullable();
            $table->string('password')->nullable();
            $table->string('country')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->string('leverage')->nullable();
            $table->string('balance')->default('0');
            $table->string('credit')->nullable();
            $table->string('equity')->nullable();
            $table->string('margin_level_percentage')->nullable();
            $table->string('profit')->nullable();
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
