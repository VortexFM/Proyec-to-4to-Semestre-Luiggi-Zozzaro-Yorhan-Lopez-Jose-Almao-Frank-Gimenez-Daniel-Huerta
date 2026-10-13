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
        Schema::table('addresses', function (Blueprint $table) {
            // Eliminar columnas antiguas
            $table->dropColumn(['address', 'city', 'state', 'postal_code']);

            // Agregar nuevas columnas venezolanas
            $table->string('estado', 100)->after('phone');
            $table->string('municipio', 100)->after('estado');
            $table->string('parroquia', 100)->after('municipio');
            $table->string('ciudad', 100)->after('parroquia');
            $table->string('urbanizacion', 150)->nullable()->after('ciudad');
            $table->string('calle', 150)->nullable()->after('urbanizacion');
            $table->string('casa', 50)->nullable()->after('calle');
            $table->text('punto_referencia')->nullable()->after('casa');
            $table->string('codigo_postal', 10)->nullable()->after('punto_referencia');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('addresses', function (Blueprint $table) {
            // Eliminar columnas nuevas
            $table->dropColumn([
                'estado',
                'municipio',
                'parroquia',
                'ciudad',
                'urbanizacion',
                'calle',
                'casa',
                'punto_referencia',
                'codigo_postal',
            ]);

            // Restaurar columnas antiguas
            $table->string('address', 255)->after('phone');
            $table->string('city', 100)->after('address');
            $table->string('state', 100)->after('city');
            $table->string('postal_code', 20)->nullable()->after('state');
        });
    }
};