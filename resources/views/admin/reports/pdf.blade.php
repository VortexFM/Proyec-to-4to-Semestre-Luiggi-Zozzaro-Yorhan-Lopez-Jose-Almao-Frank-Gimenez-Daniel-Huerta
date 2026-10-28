<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>{{ $titulo }}</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        h1 { text-align: center; color: #7c3aed; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f3f4f6; font-weight: bold; }
        .footer { text-align: center; margin-top: 30px; font-size: 10px; color: #9ca3af; }
    </style>
</head>
<body>
    <h1>{{ $titulo }}</h1>
    <p>Generado el: {{ date('d/m/Y H:i') }}</p>

    <table>
        <thead>
            <tr>
                @foreach($columnas as $col)
                    <th>{{ $col }}</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @foreach($data as $item)
                <tr>
                    @if($tipo === 'productos')
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->category->name ?? 'N/A' }}</td>
                        <td>${{ $item->price }}</td>
                        <td>{{ $item->stock }}</td>
                    @elseif($tipo === 'pedidos')
                        <td>{{ $item->order_number }}</td>
                        <td>{{ $item->shipping_name }}</td>
                        <td>${{ $item->total }}</td>
                        <td>{{ $item->status }}</td>
                    @else
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->email }}</td>
                        <td>{{ $item->role }}</td>
                        <td>{{ $item->created_at->format('d/m/Y') }}</td>
                    @endif
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">Mi Tienda - Reporte generado automáticamente</div>
</body>
</html>