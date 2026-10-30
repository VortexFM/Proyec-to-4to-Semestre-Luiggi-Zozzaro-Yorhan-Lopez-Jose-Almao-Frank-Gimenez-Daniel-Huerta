<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->renameColumn('shipping_estado', 'shipping_state');
            $table->renameColumn('shipping_municipio', 'shipping_municipality');
            $table->renameColumn('shipping_parroquia', 'shipping_parish');
            $table->renameColumn('shipping_ciudad', 'shipping_city');
            $table->renameColumn('shipping_urbanizacion', 'shipping_neighborhood');
            $table->renameColumn('shipping_calle', 'shipping_street');
            $table->renameColumn('shipping_casa', 'shipping_house_number');
            $table->renameColumn('shipping_punto_referencia', 'shipping_reference_point');
            $table->renameColumn('shipping_codigo_postal', 'shipping_postal_code');
        });
    }

    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->renameColumn('shipping_state', 'shipping_estado');
            $table->renameColumn('shipping_municipality', 'shipping_municipio');
            $table->renameColumn('shipping_parish', 'shipping_parroquia');
            $table->renameColumn('shipping_city', 'shipping_ciudad');
            $table->renameColumn('shipping_neighborhood', 'shipping_urbanizacion');
            $table->renameColumn('shipping_street', 'shipping_calle');
            $table->renameColumn('shipping_house_number', 'shipping_casa');
            $table->renameColumn('shipping_reference_point', 'shipping_punto_referencia');
            $table->renameColumn('shipping_postal_code', 'shipping_codigo_postal');
        });
    }
};