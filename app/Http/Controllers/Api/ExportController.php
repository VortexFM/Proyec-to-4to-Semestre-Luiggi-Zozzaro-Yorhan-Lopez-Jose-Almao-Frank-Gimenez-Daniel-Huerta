<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\IOFactory;

class ExportController extends Controller
{
    // ==========================================
    // EXPORTAR A EXCEL (.xlsx con diseño)
    // ==========================================
    public function excel(Request $request)
    {
        $tipo = $request->query('tipo', 'productos');

        // Si es productos, usamos la clase bonita que creamos
        if ($tipo === 'productos') {
            return \Maatwebsite\Excel\Facades\Excel::download(new \App\Exports\ProductsExport, 'reporte_productos_' . date('Y-m-d') . '.xlsx');
        }

        // Para pedidos y clientes, mantenemos el CSV básico por ahora
        $headers = [
            "Content-type" => "text/csv",
            "Content-Disposition" => "attachment; filename=reporte_{$tipo}_" . date('Y-m-d') . ".csv",
        ];

        $callback = function() use ($tipo) {
            $file = fopen('php://output', 'w');
            
            if ($tipo === 'pedidos') {
                fputcsv($file, ['Nº Orden', 'Cliente', 'Total', 'Estado', 'Fecha']);
                foreach (Order::all() as $o) {
                    fputcsv($file, [$o->order_number, $o->shipping_name, $o->total, $o->status, $o->created_at->format('d/m/Y')]);
                }
            } else {
                fputcsv($file, ['ID', 'Nombre', 'Email', 'Rol', 'Registro']);
                foreach (User::all() as $u) {
                    fputcsv($file, [$u->id, $u->name, $u->email, $u->role, $u->created_at->format('d/m/Y')]);
                }
            }
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    // ==========================================
    // EXPORTAR VENTAS A EXCEL
    // ==========================================
    public function salesExcel()
    {
        return \Maatwebsite\Excel\Facades\Excel::download(new \App\Exports\SalesExport, 'reporte_ventas_' . date('Y-m-d') . '.xlsx');
    }

    // ==========================================
    // EXPORTAR A PDF
    // ==========================================
    public function pdf(Request $request)
    {
        $tipo = $request->query('tipo', 'productos');
        
        if ($tipo === 'productos') {
            $data = Product::with('category')->get();
            $titulo = 'Reporte de Productos';
            $columnas = ['Nombre', 'Categoría', 'Precio', 'Stock'];
        } elseif ($tipo === 'pedidos') {
            $data = Order::all();
            $titulo = 'Reporte de Pedidos';
            $columnas = ['Nº Orden', 'Cliente', 'Total', 'Estado'];
        } else {
            $data = User::all();
            $titulo = 'Reporte de Clientes';
            $columnas = ['Nombre', 'Email', 'Rol', 'Registro'];
        }

        $pdf = Pdf::loadView('admin.reports.pdf', compact('data', 'titulo', 'columnas', 'tipo'));
        return $pdf->download("reporte_{$tipo}_" . date('Y-m-d') . ".pdf");
    }

    // ==========================================
    // EXPORTAR A WORD (Usando HTML nativo)
    // ==========================================
    public function word(Request $request)
    {
        $tipo = $request->query('tipo', 'productos');
        
        if ($tipo === 'productos') {
            $data = Product::with('category')->get();
            $titulo = 'Reporte de Productos';
            $columnas = ['Nombre', 'Categoría', 'Precio', 'Stock'];
        } elseif ($tipo === 'pedidos') {
            $data = Order::all();
            $titulo = 'Reporte de Pedidos';
            $columnas = ['Nº Orden', 'Cliente', 'Total', 'Estado'];
        } else {
            $data = User::all();
            $titulo = 'Reporte de Clientes';
            $columnas = ['Nombre', 'Email', 'Rol', 'Registro'];
        }

        // Generamos el HTML con un diseño simple
        $html = '<html><head><meta charset="utf-8"><style>
            body { font-family: Arial, sans-serif; }
            table { width: 100%; border-collapse: collapse; margin-top: 20px; }
            th, td { border: 1px solid #000; padding: 8px; text-align: left; }
            th { background-color: #f2f2f2; }
        </style></head><body>';
        
        $html .= "<h1>{$titulo}</h1>";
        $html .= "<p>Generado el: " . date('d/m/Y H:i') . "</p>";
        
        $html .= '<table><thead><tr>';
        foreach ($columnas as $col) {
            $html .= "<th>{$col}</th>";
        }
        $html .= '</tr></thead><tbody>';

        foreach ($data as $item) {
            $html .= '<tr>';
            if ($tipo === 'productos') {
                $html .= "<td>{$item->name}</td><td>" . ($item->category->name ?? 'N/A') . "</td><td>\${$item->price}</td><td>{$item->stock}</td>";
            } elseif ($tipo === 'pedidos') {
                $html .= "<td>{$item->order_number}</td><td>{$item->shipping_name}</td><td>\${$item->total}</td><td>{$item->status}</td>";
            } else {
                $html .= "<td>{$item->name}</td><td>{$item->email}</td><td>{$item->role}</td><td>" . $item->created_at->format('d/m/Y') . "</td>";
            }
            $html .= '</tr>';
        }
        $html .= '</tbody></table></body></html>';

        // Enviamos el archivo forzando la descarga como .doc
        $filename = "reporte_{$tipo}_" . date('Y-m-d') . ".doc";
        
        return response($html)
            ->header('Content-Type', 'application/msword')
            ->header('Content-Disposition', 'attachment; filename="' . $filename . '"');
    }

    public function ordersExcel() {
        return \Maatwebsite\Excel\Facades\Excel::download(new \App\Exports\OrdersExport, 'reporte_pedidos_' . date('Y-m-d') . '.xlsx');
    }

    public function addressesExcel() {
        return \Maatwebsite\Excel\Facades\Excel::download(new \App\Exports\AddressesExport, 'reporte_direcciones_' . date('Y-m-d') . '.xlsx');
    }

    public function usersExcel() {
        return \Maatwebsite\Excel\Facades\Excel::download(new \App\Exports\UsersExport, 'reporte_clientes_' . date('Y-m-d') . '.xlsx');
    }
}