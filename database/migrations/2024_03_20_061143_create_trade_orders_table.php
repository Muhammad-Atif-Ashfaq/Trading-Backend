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
        Schema::create('trade_orders', function (Blueprint $table) {
            $table->id();
            $table->enum('order_type', \App\Enums\OrderTypeEnum::getOrderTypes());
            $table->string('symbol');
            $table->unsignedBigInteger('trading_account_id');
            $table->bigInteger('trading_group_id')->nullable();
            $table->string('group_unique_id')->nullable();
            $table->enum('type', \App\Enums\TradeOrderTypeEnum::getTypes());
            $table->string('volume');
            $table->string('stopLoss')->nullable();
            $table->string('takeProfit')->nullable();
            $table->string('price');
            $table->string('stop_limit_price')->nullable();
            $table->string('open_time');
            $table->string('open_price');
            $table->string('close_time')->nullable();
            $table->string('close_price')->nullable();
            $table->string('reason')->nullable();
            $table->string('swap')->nullable();
            $table->string('profit')->nullable();
            $table->text('comment')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trade_orders');
    }
};
