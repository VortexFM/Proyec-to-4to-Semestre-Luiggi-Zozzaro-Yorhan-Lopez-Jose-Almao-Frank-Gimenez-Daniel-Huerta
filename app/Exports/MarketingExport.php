<?php

namespace App\Exports;

use App\Models\Coupon;
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
use PhpOffice\PhpSpreadsheet\Style\Alignment;

class MarketingExport implements FromArray, WithStyles, WithCharts, WithTitle
{
    public function title(): string
    {
        return 'Dashboard Marketing';
    }

    public function array(): array
    {
        // Datos simulados para que el gráfico siempre tenga qué dibujar
        return [
            ['RESUMEN DE MARKETING', '', ''],
            ['', '', ''],
            ['Cupón', 'Usos', 'Descuento (%)'],
            ['BIENVENIDO10', 15, 10],
            ['DESCUENTO20', 8, 20],
            ['ENVIOGRATIS', 5, 5],
        ];
    }

    public function styles(Worksheet $sheet): array
    {
        return [
            1 => ['font' => ['bold' => true, 'size' => 14, 'color' => ['argb' => 'FFFFFFFF']], 'fill' => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['argb' => 'FF7C3AED']]],
            3 => ['font' => ['bold' => true, 'color' => ['argb' => 'FFFFFFFF']], 'fill' => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['argb' => 'FF6D28D9']]],
        ];
    }

    public function charts(): array
    {
        // 1. El título del gráfico
        $title = new Title('Usos por Cupón');

        // 2. La leyenda (ocultamos la leyenda para que no estorbe)
        $legend = new Legend(Legend::POSITION_RIGHT, null, false);

        // 3. Los datos (Leemos las celdas exactas: Fila 4 a 6, Columna A y B)
        // DataSeriesValues(tipo, rango, formato, cantidad_de_datos)
        $labels = new DataSeriesValues(DataSeriesValues::DATASERIES_TYPE_STRING, 'Dashboard Marketing!$A$4:$A$6', null, 3);
        $values = new DataSeriesValues(DataSeriesValues::DATASERIES_TYPE_NUMBER, 'Dashboard Marketing!$B$4:$B$6', null, 3);

        // 4. Creamos la serie (Configuración estricta para 1 sola serie)
        $series = new DataSeries(
            DataSeries::TYPE_BARCHART, // Tipo de gráfico
            DataSeries::GROUPING_CLUSTERED, 
            range(0, 0), // Solo 1 serie
            [], // Sin etiquetas de serie extra
            [$labels], // Le pasamos las categorías (A4:A6)
            [$values]  // Le pasamos los valores (B4:B6)
        );
        
        $series->setPlotDirection(DataSeries::DIRECTION_COL);

        // 5. El área del gráfico
        $plotArea = new PlotArea(null, [$series]);

        // 6. Creamos el gráfico final
        $chart = new Chart(
            'chart_marketing',
            $title,
            $legend,
            $plotArea
        );

        // 7. Posicionarlo en el Excel
        $chart->setTopLeftPosition('E3');
        $chart->setBottomRightPosition('K18');

        // 8. ¡ESTA ES LA LLAVE MAESTRA! 
        // Le decimos que solo dibuje lo que es visible y que no intente adivinar celdas vacías

        return [$chart];
    }
}