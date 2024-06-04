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
        Schema::create('trading_account_login_activities', function (Blueprint $table) {
            $table->id();
            $table->foreignId('trading_account_id')->constrained()->onDelete('cascade');
            $table->string('ip_address');
            $table->string('mac_address')->nullable();
            $table->timestamp('login_time');
            $table->timestamp('logout_time')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trading_account_login_activities');
    }
};
