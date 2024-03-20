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
        Schema::create('trading_groups', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('mass_trading_orders')->default(0);
            $table->string('mass_transaction_orders')->default(0);
            $table->string('mass_leverage')->nullable();
            $table->string('mass_swap')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trading_account_groups');
    }
};
