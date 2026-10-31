<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            // Si las columnas en inglés no existen, las creamos
            if (!Schema::hasColumn('orders', 'shipping_state')) {
                $table->string('shipping_state')->nullable();
                $table->string('shipping_municipality')->nullable();
                $table->string('shipping_parish')->nullable();
                $table->string('shipping_city')->nullable();
                $table->string('shipping_neighborhood')->nullable();
                $table->string('shipping_street')->nullable();
                $table->string('shipping_house_number')->nullable();
                $table->text('shipping_reference_point')->nullable();
                $table->string('shipping_postal_code')->nullable();
            }
        });
    }

    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn([
                'shipping_state', 'shipping_municipality', 'shipping_parish', 
                'shipping_city', 'shipping_neighborhood', 'shipping_street', 
                'shipping_house_number', 'shipping_reference_point', 'shipping_postal_code'
            ]);
        });
    }
};