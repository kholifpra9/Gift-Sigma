<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('gift_orders', function (Blueprint $table) {
            $table->id();

            $table->foreignId('customer_id')->constrained()->cascadeOnDelete();
            $table->foreignId('customer_service_id')->constrained()->cascadeOnDelete();

            $table->smallInteger('status')->comment('1=Pending, 5=Delivered');
            $table->timestampsTz();
        });

        // BRIN Index
        DB::statement('CREATE INDEX gift_orders_created_at_brin_idx ON gift_orders USING brin (created_at);');

        // Partial Index (WHERE status < 5)
        DB::statement('CREATE INDEX idx_sales_active_partial ON gift_orders (status) WHERE status < 5;');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gift_orders');
    }
};
