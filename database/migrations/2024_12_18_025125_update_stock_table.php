<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('stockin', function (Blueprint $table) {
            $table->decimal('unit_price', 15, 2)->after('stock');
            $table->decimal('total_price', 15, 2)->after('unit_price');
        });

        Schema::table('stockout', function (Blueprint $table) {
            $table->decimal('unit_price', 15, 2)->after('stock');
            $table->decimal('total_price', 15, 2)->after('unit_price');
        });
    }

    public function down(): void
    {
        Schema::table('stockin', function (Blueprint $table) {
            $table->dropColumn(['unit_price', 'total_price']);
        });

        Schema::table('stockout', function (Blueprint $table) {
            $table->dropColumn(['unit_price', 'total_price']);
        });
    }
};