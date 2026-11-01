<?php

namespace App\Exports;

use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Illuminate\Support\Facades\DB;

class StrategicExport implements FromArray, WithHeadings, ShouldAutoSize, WithStyles
{
    public function headings(): array
    {
        return ['Métrica', 'Valor'];
    }

    public function array(): array
    {
        return [
            ['Ingresos Totales ($)', Order::where('status', '!=', 'cancelado')->sum('total')],
            ['Valor del Inventario ($)', Product::sum(DB::raw('price * stock'))],
            ['Total Clientes', User::where('role', 'cliente')->count()],
            ['Pedidos Entregados', Order::where('status', 'entregado')->count()],
            ['Pedidos Pendientes', Order::where('status', 'pendiente')->count()],
        ];
    }

    public function styles(Worksheet $sheet): array
    {
        return [
            1 => ['font' => ['bold' => true, 'color' => ['argb' => 'FFFFFFFF']], 'fill' => ['fillType' => 'solid', 'startColor' => ['argb' => 'FF8B5CF6']]],
        ];
    }
}