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
        Schema::create('symbel_groups', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('leverage');
            $table->string('lot_size');
            $table->string('lot_step');
            $table->string('vol_min');
            $table->string('vol_max');
            $table->string('trading_interval')->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('symbel_groups');
    }
};
