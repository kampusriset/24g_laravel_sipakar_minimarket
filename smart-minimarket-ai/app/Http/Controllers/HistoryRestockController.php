<?php

namespace App\Http\Controllers;

use App\Models\StockHistory;

class HistoryRestockController extends Controller
{
    public function index()
    {
        $histories = StockHistory::with('product')
            ->where('jenis','restock')
            ->latest()
            ->get();

        return view(
            'restockhistory.index',
            compact('histories')
        );
    }
}