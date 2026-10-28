<?php
namespace App\Exports;
use App\Models\Address;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class AddressesExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize, WithStyles
{
    public function collection(): \Illuminate\Support\Collection { return Address::with('user')->get(); }
    public function headings(): array { return ['Cliente', 'Teléfono', 'Estado', 'Municipio', 'Ciudad', 'Dirección (Calle/Casa)', 'Referencia']; }
    public function map($address): array {
        return [
            $address->user ? $address->user->name : $address->name, $address->phone, $address->estado, 
            $address->municipio, $address->ciudad, $address->calle . ' ' . $address->casa, $address->punto_referencia
        ];
    }
    public function styles(Worksheet $sheet): array {
        return [1 => ['font' => ['bold' => true, 'color' => ['argb' => 'FFFFFFFF']], 'fill' => ['fillType' => 'solid', 'startColor' => ['argb' => 'FF3B82F6']]]]; // Azul
    }
}