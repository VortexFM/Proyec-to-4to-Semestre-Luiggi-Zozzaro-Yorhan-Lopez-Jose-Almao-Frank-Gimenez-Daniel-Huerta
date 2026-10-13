<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Address;
use App\Models\User;

class AddressSeeder extends Seeder
{
    public function run(): void
    {
        $clientes = User::where('role', 'cliente')->get();

        if ($clientes->isEmpty()) {
            $this->command->warn('No hay clientes. Ejecuta primero UserSeeder.');
            return;
        }

        $direcciones = [
            [
                'name' => 'Juan Pérez',
                'phone' => '0412-1234567',
                'estado' => 'Lara',
                'municipio' => 'Iribarren',
                'parroquia' => 'Concepción',
                'ciudad' => 'Barquisimeto',
                'urbanizacion' => 'Nueva Segovia',
                'calle' => 'Calle 8',
                'casa' => 'Casa 5',
                'punto_referencia' => 'Frente a la plaza',
                'codigo_postal' => '3001',
                'default' => true,
            ],
            [
                'name' => 'María Gómez',
                'phone' => '0414-2345678',
                'estado' => 'Lara',
                'municipio' => 'Iribarren',
                'parroquia' => 'Santa Rosa',
                'ciudad' => 'Barquisimeto',
                'urbanizacion' => 'Los Samanes',
                'calle' => 'Av. Venezuela',
                'casa' => 'Apto 3B',
                'punto_referencia' => 'Al lado del colegio',
                'codigo_postal' => '3001',
                'default' => true,
            ],
            [
                'name' => 'Carlos Ruiz',
                'phone' => '0424-3456789',
                'estado' => 'Lara',
                'municipio' => 'Palavecino',
                'parroquia' => 'Cabudare',
                'ciudad' => 'Cabudare',
                'urbanizacion' => 'El Paraíso',
                'calle' => 'Carrera 19',
                'casa' => 'Casa 12',
                'punto_referencia' => 'Cerca del mercado',
                'codigo_postal' => '3023',
                'default' => true,
            ],
            [
                'name' => 'Ana López',
                'phone' => '0416-4567890',
                'estado' => 'Lara',
                'municipio' => 'Iribarren',
                'parroquia' => 'Catedral',
                'ciudad' => 'Barquisimeto',
                'urbanizacion' => 'Centro',
                'calle' => 'Calle 20',
                'casa' => 'Torre B',
                'punto_referencia' => 'Frente al banco',
                'codigo_postal' => '3001',
                'default' => true,
            ],
        ];

        foreach ($clientes as $index => $cliente) {
            $direccion = $direcciones[$index % count($direcciones)];

            Address::create([
                'user_id' => $cliente->id,
                'name' => $direccion['name'],
                'phone' => $direccion['phone'],
                'estado' => $direccion['estado'],
                'municipio' => $direccion['municipio'],
                'parroquia' => $direccion['parroquia'],
                'ciudad' => $direccion['ciudad'],
                'urbanizacion' => $direccion['urbanizacion'],
                'calle' => $direccion['calle'],
                'casa' => $direccion['casa'],
                'punto_referencia' => $direccion['punto_referencia'],
                'codigo_postal' => $direccion['codigo_postal'],
                'default' => $direccion['default'],
            ]);
        }
    }
}