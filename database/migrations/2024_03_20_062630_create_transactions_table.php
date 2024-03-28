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
        Schema::create('transaction_orders', function (Blueprint $table) {
            $table->id();
            $table->string('amount');
            $table->string('currency');
            $table->foreignId('trading_account_id')->nullable()->constrained('trading_accounts')->onDelete('cascade');
            $table->string('name');
            $table->string('group');
            $table->string('country')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->enum('type', ['deposit', 'withdraw']);
            $table->enum('method', \App\Enums\TransactionOrderMethodEnum::getMethods());
            $table->enum('status', \App\Enums\TransactionOrderStatusEnum::getStatuses());
            $table->text('comment')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaction_orders');
    }
};
