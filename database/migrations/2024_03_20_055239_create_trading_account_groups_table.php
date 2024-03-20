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
        Schema::create('trading_account_groups', function (Blueprint $table) {
            $table->id();
            $table->foreignId('trading_group_id')->references('id')->on('trading_groups')->onDelete('cascade');
            $table->foreignId('trading_account_id')->references('id')->on('trading_accounts')->onDelete('cascade');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->nullable();
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
