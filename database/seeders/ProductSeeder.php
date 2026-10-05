<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $categorias = Category::all();

        if($categorias->isEmpty()){
            $this->command->warn('No hay categorias. Ejecuta primero CategorySeeder.');
            return;
        }

        $productos = [
            ['name' => 'Camisa estampada',        'price' => 25.00, 'stock' => 15],
            ['name' => 'Franela deportiva',        'price' => 22.00, 'stock' => 20],
            ['name' => 'Pantalón casual',          'price' => 35.00, 'stock' => 10],
            ['name' => 'Bolso artesanal',          'price' => 30.00, 'stock' => 8],
            ['name' => 'Collar tejido',            'price' => 18.00, 'stock' => 12],
            ['name' => 'Pulsera de cuero',         'price' => 12.00, 'stock' => 25],
            ['name' => 'Torta de chocolate',       'price' => 15.00, 'stock' => 5],
            ['name' => 'Galletas caseras',         'price' => 8.00,  'stock' => 30],
            ['name' => 'Mermelada artesanal',      'price' => 10.00, 'stock' => 18],
            ['name' => 'Novela contemporánea',     'price' => 20.00, 'stock' => 15],
            ['name' => 'Libro de arte',            'price' => 45.00, 'stock' => 6],
            ['name' => 'Cuaderno decorado',        'price' => 7.00,  'stock' => 40],
            ['name' => 'Anillo de plata',          'price' => 50.00, 'stock' => 5],
            ['name' => 'Aretes artesanales',       'price' => 15.00, 'stock' => 20],
            ['name' => 'Juguete de madera',        'price' => 28.00, 'stock' => 10],
            ['name' => 'Rompecabezas',             'price' => 12.00, 'stock' => 15],
            ['name' => 'Jarrón decorativo',        'price' => 40.00, 'stock' => 4],
            ['name' => 'Cuadro pintado a mano',    'price' => 65.00, 'stock' => 3],
            ['name' => 'Crema hidratante',         'price' => 18.00, 'stock' => 25],
            ['name' => 'Jabón artesanal',          'price' => 6.00,  'stock' => 50],
        ];

        foreach($productos as $index => $producto){
            $categoria = $categorias[$index % $categorias->count()];

            Product::create([
                'category_id' => $categoria->id,
                'name' => $producto['name'],
                'slug' => Str::slug($producto['name']),
                'description' => 'Description detallada de' . $producto['name'] . '. Producto de alta calidad.',
                'price' => $producto['price'],
                'sale_price' => $index % 5 === 0 ? $producto['price'] * 0.8 : null, 
                'stock' => $producto['stock'],
                'sku' => 'SKU-' .str_pad($index + 1, 4, '0', STR_PAD_LEFT),
                'featured' => $index < 8,
                'active' => true,
            ]);
        }
    }
}
