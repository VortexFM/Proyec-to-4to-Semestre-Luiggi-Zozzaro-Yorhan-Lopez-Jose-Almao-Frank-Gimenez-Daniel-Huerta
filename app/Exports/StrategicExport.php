<?php

namespace App\Exports;

use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithCharts;
use Maatwebsite\Excel\Concerns\WithTitle;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Chart\Chart;
use PhpOffice\PhpSpreadsheet\Chart\DataSeries;
use PhpOffice\PhpSpreadsheet\Chart\DataSeriesValues;
use PhpOffice\PhpSpreadsheet\Chart\Legend;
use PhpOffice\PhpSpreadsheet\Chart\PlotArea;
use PhpOffice\PhpSpreadsheet\Chart\Title;
use PhpOffice\PhpSpreadsheet\Style\Fill;

class StrategicExport implements FromArray, WithStyles, WithCharts, WithTitle
{
    // 1. Nombre de la pestaña
    public function title(): string
    {
        return 'Dashboard';
    }

    // 2. Datos que se escribirán en el Excel
    public function array(): array
    {
        $ingresos = Order::where('status', '!=', 'cancelado')->sum('total');
        $inventario = Product::sum(DB::raw('price * stock'));
        $clientes = User::where('role', 'cliente')->count();
        $entregados = Order::where('status', 'entregado')->count();
        $pendientes = Order::where('status', 'pendiente')->count();

        return [
            ['RESUMEN ESTRATÉGICO - MI TIENDA', '', ''], // Fila 1
            ['', '', ''], // Fila 2 (vacía para separar)
            ['Métrica', 'Valor', 'Estado'], // Fila 3 (Cabeceras)
            ['Ingresos Totales ($)', $ingresos, 'Activo'],
            ['Valor del Inventario ($)', $inventario, 'Activo'],
            ['Clientes Registrados', $clientes, 'Activo'],
            ['Pedidos Entregados', $entregados, 'Completado'],
            ['Pedidos Pendientes', $pendientes, 'Alerta'],
        ];
    }

    // 3. Estilos visuales (Morado de tu tienda)
    public function styles(Worksheet $sheet): array
    {
        return [
            // Título Principal
            1 => [
                'font' => ['bold' => true, 'size' => 14, 'color' => ['argb' => 'FFFFFFFF']],
                'fill' => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['argb' => 'FF7C3AED']],
            ],
            // Cabeceras de la tabla (Fila 3)
            3 => [
                'font' => ['bold' => true, 'color' => ['argb' => 'FFFFFFFF']],
                'fill' => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['argb' => 'FF6D28D9']],
            ],
            // Columna de Métricas
            'A' => ['font' => ['bold' => true]],
        ];
    }

    // 4. Gráfico (Corregido)
        public function charts(): array
    {
        // 1. Categorías: Leemos la columna A (Filas 4 y 5: Ingresos e Inventario)
        $categories = new DataSeriesValues(
            DataSeriesValues::DATASERIES_TYPE_STRING, 
            'Dashboard!$A$4:$A$5', 
            null, 
            2
        );

        // 2. Valores: Leemos la columna B (Filas 4 y 5: Los montos)
        $values = new DataSeriesValues(
            DataSeriesValues::DATASERIES_TYPE_NUMBER, 
            'Dashboard!$B$4:$B$5', 
            null, 
            2
        );

        // 3. Creamos la serie (Gráfico de Barras)
        $series = new DataSeries(
            DataSeries::TYPE_BARCHART,
            DataSeries::GROUPING_CLUSTERED,
            range(0, 1),
            [], 
            [$categories], 
            [$values]      
        );
        
        $series->setPlotDirection(DataSeries::DIRECTION_COL);

        $plotArea = new PlotArea(null, [$series]);

        $chart = new Chart(
            'chart_financiero', // Nombre interno
            new Title('Ingresos vs Inventario'), // Título
            new Legend(Legend::POSITION_RIGHT),
            $plotArea
        );

        // Posicionar el gráfico (Lo hacemos más grande)
        $chart->setTopLeftPosition('E3');
        $chart->setBottomRightPosition('K18');

        return [$chart];
    }
}