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
        Schema::table('customers', function (Blueprint $table) {
            $table->text('phone')->nullable()->after('name');
            $table->text('address')->nullable()->after('phone');
            $table->text('city')->nullable()->after('address');
            $table->text('province')->nullable()->after('city');
            $table->text('postal_code')->nullable()->after('province');
        });
    }

    public function down(): void
    {
        Schema::table('customers', function (Blueprint $table) {
            $table->dropColumn([
                'phone',
                'address',
                'city',
                'province',
                'postal_code'
            ]);
        });
    }
};
