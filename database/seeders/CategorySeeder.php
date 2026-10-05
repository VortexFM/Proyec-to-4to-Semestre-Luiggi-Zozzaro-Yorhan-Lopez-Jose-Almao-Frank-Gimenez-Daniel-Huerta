<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categorias = [
            ['name' => 'Ropa', 'icon' => '👕' ],
            ['name' => 'Artesania', 'icon' => '🎨' ],
            ['name' => 'Alimentos', 'icon' => '🍰' ],
            ['name' => 'Libros', 'icon' => '📚' ],
            ['name' => 'Accesorios', 'icon' => '💍' ],
            ['name' => 'Juguetes', 'icon' => '🧸' ],
            ['name' => 'Decoracion', 'icon' => '🏺' ],
            ['name' => 'Belleza', 'icon' => '🌸' ],
        ];

        foreach ($categorias as $categoria) {
            Category::create([
                'name' => $categoria['name'],
                'slug' => Str::slug($categoria['name']),
                'description' => 'Productos de la categoría ' . $categoria['name'],
                'icon' => $categoria['icon'],
                'active' => true,
            ]);
        }
    }
}
