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
            $table->string('speed_min')->nullable();
            $table->string('speed_max')->nullable();
            $table->string('lot_size')->nullable();
            $table->string('lot_step')->nullable();
            $table->string('commission')->nullable();
            $table->string('swap_long')->nullable();
            $table->string('swap_short')->nullable();
            $table->string('enabled')->default(0);
            $table->string('viable')->default(0);
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
