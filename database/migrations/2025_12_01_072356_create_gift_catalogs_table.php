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
        Schema::create('gift_catalogs', function (Blueprint $table) {
            $table->id();
            $table->text('name');
            $table->text('link')->nullable();
            $table->text('platform')->nullable();
            $table->timestampsTz();
        });

        // GIN TRGM Index for fuzzy search
        DB::statement('CREATE INDEX gift_catalogs_name_trgm_idx ON gift_catalogs USING gin (name gin_trgm_ops);');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gift_catalogs');
    }
};
