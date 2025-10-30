<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Factura - Ticket</title>
    <style>
        body {
            font-family: 'Courier New', monospace;
            margin: 0;
            padding: 5px;
            font-size: 10px;
            width: 80mm;
        }
        .header {
            text-align: center;
            margin-bottom: 10px;
            border-bottom: 1px solid #000;
            padding-bottom: 5px;
        }
        .company-info, .invoice-info {
            margin-bottom: 10px;
            text-align: center;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 10px;
        }
        th, td {
            padding: 3px;
            text-align: left;
        }
        .total {
            text-align: center;
            font-weight: bold;
            border-top: 1px dashed #000;
            padding-top: 5px;
            margin-top: 10px;
        }
        .footer {
            text-align: center;
            font-size: 8px;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="header">
        <strong>FACTURA</strong>
    </div>
    
    <div class="company-info">
        <strong>{{ $company->name }}</strong><br>
        {{ $company->address }}
    </div>
    
    <div class="invoice-info">
        <strong>#{{ $invoice->number }}</strong><br>
        {{ $invoice->date }}<br>
        Cliente: {{ $invoice->client->name }}
    </div>
    
    <table>
        <thead>
            <tr>
                <th>Desc</th>
                <th>Cant</th>
                <th>P.U</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach($invoice->items as $item)
            <tr>
                <td>{{ Str::limit($item->description, 15) }}</td>
                <td>{{ $item->quantity }}</td>
                <td>${{ number_format($item->unit_price, 2) }}</td>
                <td>${{ number_format($item->quantity * $item->unit_price, 2) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    
    <div class="total">
        TOTAL: ${{ number_format($invoice->total, 2) }}
    </div>
    
    <div class="footer">
        ¡Gracias!
    </div>
</body>
</html>