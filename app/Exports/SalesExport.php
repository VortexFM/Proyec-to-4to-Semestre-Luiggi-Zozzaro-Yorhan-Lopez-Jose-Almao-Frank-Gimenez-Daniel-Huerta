<?php

namespace App\Exports;

use App\Models\OrderItem;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class SalesExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize, WithStyles
{
    public function collection(): \Illuminate\Support\Collection
    {
        // Traemos los items vendidos, junto con su orden y el producto
        return OrderItem::with(['order', 'product'])->get();
    }

    public function headings(): array
    {
        return [
            'Nº Orden',
            'Fecha',
            'Cliente',
            'Producto',
            'Cantidad',
            'Precio Venta',
            'Subtotal',
            'Estado Pedido'
        ];
    }

    public function map($item): array
    {
        return [
            $item->order ? $item->order->order_number : 'N/A',
            $item->order ? $item->order->created_at->format('d/m/Y') : 'N/A',
            $item->order ? $item->order->shipping_name : 'N/A',
            $item->product ? $item->product->name : 'Producto Eliminado',
            $item->quantity,
            $item->price,
            $item->subtotal,
            $item->order ? strtoupper($item->order->status) : 'N/A',
        ];
    }

    public function styles(Worksheet $sheet): array
    {
        return [
            1 => [
                'font' => ['bold' => true, 'color' => ['argb' => 'FFFFFFFF']],
                'fill' => [
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'startColor' => ['argb' => 'FF10B981'] // Color verde para ventas
                ],
            ],
        ];
    }
}