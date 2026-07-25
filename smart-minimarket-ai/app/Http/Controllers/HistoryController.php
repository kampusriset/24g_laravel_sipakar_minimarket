<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use Barryvdh\DomPDF\Facade\Pdf;

class HistoryController extends Controller
{
    /**
     * Daftar seluruh transaksi
     */
    public function index()
    {
        $sales = Sale::with('user')
            ->latest()
            ->paginate(10);

        return view('history.index', compact('sales'));
    }

    /**
     * Detail transaksi
     */
    public function show(Sale $sale)
    {
        $sale->load([
            'user',
            'saleDetails.product',
            'payment'
        ]);

        return view('history.show', compact('sale'));
    }
    public function pdf(Sale $sale)
    {
        $sale->load([
            'user',
            'saleDetails.product',
            'payment'
        ]);

        $pdf = pdf::loadView('history.invoice', compact('sale'));

        return $pdf->download($sale->invoice_number . '.pdf');
    }
}
