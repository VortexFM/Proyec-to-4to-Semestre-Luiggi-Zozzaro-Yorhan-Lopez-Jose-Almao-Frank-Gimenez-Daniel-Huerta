<?php

namespace App\Exports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class ProductsExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize, WithStyles
{
    public function collection(): \Illuminate\Support\Collection
    {
        return Product::with('category')->get();
    }

    // Cabeceras del Excel
    public function headings(): array
    {
        return [
            'ID',
            'Nombre del Producto',
            'Categoría',
            'Precio ($)',
            'Stock',
            'Estado',
        ];
    }

    // Cómo se mapean los datos de la base de datos a las columnas
    public function map($product): array
    {
        return [
            $product->id,
            $product->name,
            $product->category ? $product->category->name : 'Sin categoría',
            $product->price,
            $product->stock,
            $product->active ? 'Activo' : 'Inactivo',
        ];
    }

    // Estilos para que se vea bonito (colores, negritas)
    public function styles(Worksheet $sheet): array 
    {
        return [
            // Estilo para la fila 1 (Cabeceras)
            1 => [
                'font' => ['bold' => true, 'color' => ['argb' => 'FFFFFFFF']],
                'fill' => [
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'startColor' => ['argb' => 'FF7C3AED'] // El mismo morado de tu tienda
                ],
            ],
            // Estilo para el resto de filas (opcional)
            2 => [
                'font' => ['bold' => false],
            ],
        ];
    }
}
