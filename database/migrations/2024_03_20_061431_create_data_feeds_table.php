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
        Schema::create('data_feeds', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('module');
            $table->string('feed_server');
            $table->string('feed_login')->nullable();
            $table->string('feed_password')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_feeds');
    }
};
