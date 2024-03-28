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
        Schema::create('symbel_settings', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignId('symbel_group_id')->constrained()->on('symbel_groups')->onDelete('cascade')->nullable();
            $table->string('feed_name');
            $table->string('feed_name_fetch');
            $table->string('feed_price_fetch');
            $table->string('speed_max');
            $table->string('leverage');
            $table->string('swap');
            $table->string('lot_size');
            $table->string('lot_step');
            $table->string('vol_min');
            $table->string('vol_max');
            $table->string('commission');
            $table->string('enabled')->default(0);
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('symbel_settings');
    }
};
