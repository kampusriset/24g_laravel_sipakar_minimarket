<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Sale;
use App\Models\SaleDetail;
use App\Services\DashboardService;

class DashboardController extends Controller
{
    protected $dashboardService;

    public function __construct(DashboardService $dashboardService)
    {
        $this->dashboardService = $dashboardService;
    }

    public function index()
    {
        /*
        ======================================
        DASHBOARD PENJUALAN
        ======================================
        */

        $totalPenjualan = Sale::sum('total_harga');

        $totalTransaksi = Sale::count();

        $totalProduk = Product::count();

        $stokMenipis = Product::whereColumn('stock', '<=', 'minimum_stock')
            ->orderBy('stock')
            ->take(5)
            ->get();

        $produkTerlaris = SaleDetail::selectRaw('
                product_id,
                SUM(qty) as total
            ')
            ->with('product')
            ->groupBy('product_id')
            ->orderByDesc('total')
            ->take(5)
            ->get()
            ->map(function ($item) {

                return (object)[

                    'nama_produk' => $item->product->nama_produk,
                    'total' => $item->total

                ];

            });

        /*
        ======================================
        DASHBOARD AI
        ======================================
        */

        $ai = $this->dashboardService->getRestockAnalysis();

        /*
        ======================================
        VIEW
        ======================================
        */

        return view('dashboard.index', array_merge([

            'totalPenjualan' => $totalPenjualan,

            'totalTransaksi' => $totalTransaksi,

            'totalProduk' => $totalProduk,

            'stokMenipis' => $stokMenipis,

            'produkTerlaris' => $produkTerlaris,

        ], $ai));
    }
}