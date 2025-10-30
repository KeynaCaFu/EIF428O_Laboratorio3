<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Factura - Formato Carta</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            font-size: 12px;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 2px solid #333;
            padding-bottom: 20px;
        }
        .company-info {
            margin-bottom: 20px;
        }
        .invoice-info {
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        .total {
            text-align: right;
            font-weight: bold;
            font-size: 14px;
        }
        .footer {
            margin-top: 30px;
            text-align: center;
            font-size: 10px;
            color: #666;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>FACTURA</h1>
    </div>
    
    <div class="company-info">
        <strong>{{ $company->name }}</strong><br>
        {{ $company->address }}<br>
        Tel: {{ $company->phone }}<br>
        Email: {{ $company->email }}
    </div>
    
    <div class="invoice-info">
        <strong>Factura #:</strong> {{ $invoice->number }}<br>
        <strong>Fecha:</strong> {{ $invoice->date }}<br>
        <strong>Cliente:</strong> {{ $invoice->client->name }}
    </div>
    
    <table>
        <thead>
            <tr>
                <th>Descripción</th>
                <th>Cantidad</th>
                <th>Precio Unitario</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach($invoice->items as $item)
            <tr>
                <td>{{ $item->description }}</td>
                <td>{{ $item->quantity }}</td>
                <td>${{ number_format($item->unit_price, 2) }}</td>
                <td>${{ number_format($item->quantity * $item->unit_price, 2) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    
    <div class="total">
        <strong>TOTAL: ${{ number_format($invoice->total, 2) }}</strong>
    </div>
    
    <div class="footer">
        Gracias por su compra
    </div>
</body>
</html>