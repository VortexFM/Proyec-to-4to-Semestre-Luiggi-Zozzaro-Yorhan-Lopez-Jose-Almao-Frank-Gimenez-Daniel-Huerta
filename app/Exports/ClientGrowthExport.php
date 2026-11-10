<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Fill;

class ClientGrowthExport implements FromArray, WithHeadings, ShouldAutoSize, WithStyles
{
    public function headings(): array 
    { 
        return ['Métrica', 'Valor']; 
    }

    public function array(): array 
    {
        $esteMes = User::where('role', 'cliente')->whereMonth('created_at', now()->month)->count();
        $mesPasado = User::where('role', 'cliente')->whereMonth('created_at', now()->subMonth()->month)->count();
        
        // Forzamos a que el valor sea un string para que Excel lo muestre
        return [
            ['Nuevos Clientes Este Mes', (string) $esteMes],
            ['Clientes Mes Pasado', (string) $mesPasado],
        ];
    }

    public function styles(Worksheet $sheet): array
    {
        return [
            1 => [
                'font' => ['bold' => true, 'color' => ['argb' => 'FFFFFFFF']],
                'fill' => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['argb' => 'FFF97316']] // Naranja
            ],
        ];
    }
}