<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        $roles = [
            ['name' => 'cliente', 'description' => 'Usuario que compra productos'],
            ['name' => 'admin', 'description' => 'Administrador del sistema'],
            ['name' => 'emprendedor', 'description' => 'Emprendedor que vende productos'],
        ];

        foreach ($roles as $role) {
            Role::create($role);
        }
    }
}