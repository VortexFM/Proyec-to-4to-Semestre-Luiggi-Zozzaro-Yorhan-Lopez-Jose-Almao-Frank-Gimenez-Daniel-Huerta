<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('addresses', function (Blueprint $table) {
            $table->renameColumn('estado', 'state');
            $table->renameColumn('municipio', 'municipality');
            $table->renameColumn('parroquia', 'parish');
            $table->renameColumn('ciudad', 'city');
            $table->renameColumn('urbanizacion', 'neighborhood');
            $table->renameColumn('calle', 'street');
            $table->renameColumn('casa', 'house_number');
            $table->renameColumn('punto_referencia', 'reference_point');
            $table->renameColumn('codigo_postal', 'postal_code');
        });
    }

    public function down(): void
    {
        Schema::table('addresses', function (Blueprint $table) {
            $table->renameColumn('state', 'estado');
            $table->renameColumn('municipality', 'municipio');
            $table->renameColumn('parish', 'parroquia');
            $table->renameColumn('city', 'ciudad');
            $table->renameColumn('neighborhood', 'urbanizacion');
            $table->renameColumn('street', 'calle');
            $table->renameColumn('house_number', 'casa');
            $table->renameColumn('reference_point', 'punto_referencia');
            $table->renameColumn('postal_code', 'codigo_postal');
        });
    }
};