<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class InvoiceController extends Controller
{
    public function printInvoice($id, $format = 'letter')
    {
        // Obtener los datos de la factura (ajusta según tu modelo)
        $invoice = \App\Models\Invoice::with(['client', 'items'])->findOrFail($id);
        $company = \App\Models\Company::first(); // Ajusta según tu estructura
        
        $view = $format === 'ticket' ? 'invoices.ticket' : 'invoices.letter';
        
        $pdf = PDF::loadView($view, [
            'invoice' => $invoice,
            'company' => $company
        ]);
        
        // Configurar papel según el formato
        if ($format === 'ticket') {
            $pdf->setPaper([0, 0, 226.77, 841.89], 'portrait'); // 80mm de ancho
        } else {
            $pdf->setPaper('letter', 'portrait');
        }
        
        return $pdf->stream("factura-{$invoice->number}.pdf");
    }
}