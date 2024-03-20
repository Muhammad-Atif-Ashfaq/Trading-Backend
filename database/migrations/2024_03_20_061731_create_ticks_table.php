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
        Schema::create('ticks', function (Blueprint $table) {
            $table->id();
            $table->string('name')->references('name')->on('symbol_settings')->onDelete('cascade');
            $table->string('open');
            $table->string('high');
            $table->string('low');
            $table->string('close');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ticks');
    }
};
