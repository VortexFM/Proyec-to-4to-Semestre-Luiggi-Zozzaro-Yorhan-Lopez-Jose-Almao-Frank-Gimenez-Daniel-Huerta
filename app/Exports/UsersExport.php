<?php
namespace App\Exports;
use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class UsersExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize, WithStyles
{
    public function collection(): \Illuminate\Support\Collection { return User::all(); }
    public function headings(): array { return ['ID', 'Nombre', 'Email', 'Teléfono', 'Rol', 'Fecha de Registro']; }
    public function map($user): array {
        return [$user->id, $user->name, $user->email, $user->phone ?? 'N/A', strtoupper($user->role), $user->created_at->format('d/m/Y')];
    }
    public function styles(Worksheet $sheet): array {
        return [1 => ['font' => ['bold' => true, 'color' => ['argb' => 'FFFFFFFF']], 'fill' => ['fillType' => 'solid', 'startColor' => ['argb' => 'FF7C3AED']]]]; // Morado
    }
}