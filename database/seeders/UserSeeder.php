<?php

namespace Database\Seeders;


use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Administrador',
            'email' => 'admin@mitienda.com',
            'password' => Hash::make('admin1234'),
            'phone' => '0412-0000000',
            'role' => 'admin',

        ]);

        $clientes = [
            ['name' => 'Juan Pérez',      'email' => 'juan@correo.com',    'phone' => '0412-1234567'],
            ['name' => 'María Gómez',     'email' => 'maria@correo.com',   'phone' => '0414-2345678'],
            ['name' => 'Carlos Ruiz',     'email' => 'carlos@correo.com',  'phone' => '0424-3456789'],
            ['name' => 'Ana López',       'email' => 'ana@correo.com',     'phone' => '0416-4567890'],
        ];

        foreach($clientes as $cliente){
            User::create([
                'name' => $cliente['name'],
                'email' => $cliente['email'],
                'password' => Hash::make('cliente1234'),
                'phone' => $cliente['phone'],
                'role' => 'cliente',
            ]);

        }
    }
}
