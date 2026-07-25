<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Sale;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {

        $totalPenjualan = Sale::sum('total_harga');

        $totalTransaksi = Sale::count();

        $totalProduk = Product::count();

        $stokMenipis = Product::whereColumn(
            'stock',
            '<=',
            'minimum_stock'
        )->get();

        $produkTerlaris = DB::table('sale_details')

            ->join('products', 'sale_details.product_id', '=', 'products.id')

            ->select(
                'products.nama_produk',
                DB::raw('SUM(qty) as total')
            )

            ->groupBy('products.nama_produk')

            ->orderByDesc('total')

            ->limit(5)

            ->get();

        return view(
            'dashboard.report',
            compact(
                'totalPenjualan',
                'totalTransaksi',
                'totalProduk',
                'stokMenipis',
                'produkTerlaris'
            )
        );
    }
}
