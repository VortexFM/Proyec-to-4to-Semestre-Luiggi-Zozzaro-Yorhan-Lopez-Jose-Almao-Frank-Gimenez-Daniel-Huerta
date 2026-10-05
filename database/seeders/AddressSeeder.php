<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Address;
use App\Models\User;

class AddressSeeder extends Seeder
{
    public function run(): void
    {
        // Obtener solo los clientes (no admins)
        $clientes = User::where('role', 'cliente')->get();

        if ($clientes->isEmpty()) {
            $this->command->warn('No hay clientes. Ejecuta primero UserSeeder.');
            return;
        }

        $direcciones = [
            [
                'name' => 'Juan Pérez',
                'phone' => '0412-1234567',
                'address' => 'Calle 1, Urbanización Centro, Casa 5',
                'city' => 'Barquisimeto',
                'state' => 'Lara',
                'postal_code' => '3001',
                'default' => true,
            ],
            [
                'name' => 'María Gómez',
                'phone' => '0414-2345678',
                'address' => 'Av. Venezuela, Res. Los Samanes, Apto 3B',
                'city' => 'Barquisimeto',
                'state' => 'Lara',
                'postal_code' => '3001',
                'default' => true,
            ],
            [
                'name' => 'Carlos Ruiz',
                'phone' => '0424-3456789',
                'address' => 'Carrera 19, Sector El Paraíso, Casa 12',
                'city' => 'Cabudare',
                'state' => 'Lara',
                'postal_code' => '3023',
                'default' => true,
            ],
            [
                'name' => 'Ana López',
                'phone' => '0416-4567890',
                'address' => 'Calle 8, Urbanización Nueva Segovia, Torre B',
                'city' => 'Barquisimeto',
                'state' => 'Lara',
                'postal_code' => '3001',
                'default' => true,
            ],
        ];

        foreach ($clientes as $index => $cliente){
            $direccion = $direcciones[$index % count($direcciones)];

            Address::create([
                'user_id' => $cliente->id,
                'name' => $direccion['name'],
                'phone' => $direccion['phone'],
                'address' => $direccion['address'],
                'city' => $direccion['city'],
                'state' => $direccion['state'],
                'postal_code' => $direccion['postal_code'],
                'default' => $direccion['default'],
            ]);
        }

    }
}
