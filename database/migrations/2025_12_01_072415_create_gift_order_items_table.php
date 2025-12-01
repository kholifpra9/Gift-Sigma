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
        Schema::create('gift_order_items', function (Blueprint $table) {
            $table->id();

            $table->integer('quantity');

            $table->foreignId('gift_catalog_id')->constrained()->cascadeOnDelete();
            $table->foreignId('gift_order_id')->constrained()->cascadeOnDelete();

            $table->timestampsTz();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gift_order_items');
    }
};
