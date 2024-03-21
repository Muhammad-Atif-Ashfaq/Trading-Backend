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
        Schema::create('trading_group_symbols', function (Blueprint $table) {
            $table->id();
            $table->foreignId('symbel_setting_id')->references('id')->on('symbel_settings')->onDelete('cascade');
            $table->foreignId('trading_group_id')->references('id')->on('trading_groups')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trading_group_symbols');
    }
};
