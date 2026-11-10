<?php
namespace App\Exports;
use App\Models\Order;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;

class AverageTicketExport implements FromArray, WithHeadings
{
    public function headings(): array { return ['Métrica', 'Valor']; }
    public function array(): array {
        $totalVentas = Order::where('status', '!=', 'cancelado')->sum('total');
        $cantidadPedidos = Order::where('status', '!=', 'cancelado')->count();
        $promedio = $cantidadPedidos > 0 ? $totalVentas / $cantidadPedidos : 0;
        return [
            ['Ticket Promedio ($)', $promedio],
            ['Total Pedidos', $cantidadPedidos],
        ];
    }
}