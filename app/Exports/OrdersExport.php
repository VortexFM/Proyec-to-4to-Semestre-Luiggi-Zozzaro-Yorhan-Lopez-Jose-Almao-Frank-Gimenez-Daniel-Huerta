<?php
namespace App\Exports;
use App\Models\Order;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class OrdersExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize, WithStyles
{
    public function collection(): \Illuminate\Support\Collection { return Order::all(); }
    public function headings(): array { return ['Nº Orden', 'Cliente', 'Fecha', 'Subtotal', 'Envío', 'Total', 'Estado', 'Método Pago']; }
    public function map($order): array {
        return [
            $order->order_number, $order->shipping_name, $order->created_at->format('d/m/Y'),
            $order->subtotal, $order->shipping, $order->total, strtoupper($order->status), $order->payment_method
        ];
    }
    public function styles(Worksheet $sheet): array {
        return [1 => ['font' => ['bold' => true, 'color' => ['argb' => 'FFFFFFFF']], 'fill' => ['fillType' => 'solid', 'startColor' => ['argb' => 'FFF59E0B']]]]; // Naranja
    }
}