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
        Schema::table('orders', function (Blueprint $table) {
            $table->string('shipping_name', 100)->after('address_id');
            $table->string('shipping_phone', 20)->after('shipping_name');
            $table->string('shipping_estado', 100)->after('shipping_phone');
            $table->string('shipping_municipio', 100)->after('shipping_estado');
            $table->string('shipping_parroquia', 100)->after('shipping_municipio');
            $table->string('shipping_ciudad', 100)->after('shipping_parroquia');
            $table->string('shipping_urbanizacion', 150)->nullable()->after('shipping_ciudad');
            $table->string('shipping_calle', 150)->nullable()->after('shipping_urbanizacion');
            $table->string('shipping_casa', 50)->nullable()->after('shipping_calle');
            $table->text('shipping_punto_referencia')->nullable()->after('shipping_casa');
            $table->string('shipping_codigo_postal', 10)->nullable()->after('shipping_punto_referencia');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn([
                'shipping_name',
                'shipping_phone',
                'shipping_estado',
                'shipping_municipio',
                'shipping_parroquia',
                'shipping_ciudad',
                'shipping_urbanizacion',
                'shipping_calle',
                'shipping_casa',
                'shipping_punto_referencia',
                'shipping_codigo_postal',
            ]);
        });
    }
};