<?php
namespace App\Exports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class StagnantProductsExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize, WithStyles
{
    public function collection(): \Illuminate\Support\Collection
    {
        return Product::where('stock', '>', 10)->whereDoesntHave('orderItems')->get();
    }

    public function headings(): array
    {
        return ['ID', 'Nombre del Producto', 'Precio ($)', 'Stock'];
    }

    // 👇 Mapeamos solo los datos que queremos
    public function map($product): array
    {
        return [
            $product->id,
            $product->name,
            $product->price,
            $product->stock,
        ];
    }

    public function styles(Worksheet $sheet): array
    {
        return [
            1 => [
                'font' => ['bold' => true, 'color' => ['argb' => 'FFFFFFFF']],
                'fill' => ['fillType' => 'solid', 'startColor' => ['argb' => 'FF10B981']]
            ]
        ];
    }
}