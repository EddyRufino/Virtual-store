<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte</title>
</head>
<body>
    <table>
        <thead>
            <tr>
                <th>Producto</th>
                <th>Precio</th>
                <th>Cantidad</th>
                <th>Cobrar</th>
                <th>Fecha</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($orders as $order)
                <tr>
                    <td>{{ $order->product->name }}</td>
                    <td>{{ $order->product->price }}</td>
                    <td>{{ $order->quantity }}</td>
                    <td>{{ $order->quantity * $order->product->price }}</td>
                    <td>{{ $order->created_at->format('d-m-Y') }}</td>
                    @php
                        $count = 0;
                        foreach ($orders as $order) {
                            $count += $order->quantity * $order->product->price;
                        }
                    @endphp
                </tr>
            @endforeach
                <tr>
                    <td>Total: </td>
                    <td>{{ $count }}</td>
                </tr>
        </tbody>
    </table>
</body>
</html>
