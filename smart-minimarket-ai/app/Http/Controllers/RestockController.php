<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\SaleDetail;
use App\Services\FuzzyService;
use carbon\Carbon;

class RestockController extends Controller
{
    protected $fuzzy;

    public function __construct(FuzzyService $fuzzy)
    {
        $this->fuzzy = $fuzzy;
    }

    public function index()
    {
        $products = Product::with('category')
            ->orderBy('nama_produk')
            ->get();

        $fuzzyData = [];

        foreach ($products as $product) {

            $penjualan = SaleDetail::where('product_id', $product->id)
                ->sum('qty');

            $hasil = $this->fuzzy->calculate(
                $product->stock,
                $product->minimum_stock,
                $penjualan
            );
            // ==========================
            // Menentukan Rule Fuzzy
            // ==========================

            $rule = '';

            if (
                $hasil['membership']['stock']['sedikit'] >= max(
                    $hasil['membership']['stock']['sedang'],
                    $hasil['membership']['stock']['banyak']
                )
            ) {

                $stockRule = 'Stock Sedikit';
            } elseif (
                $hasil['membership']['stock']['sedang'] >=
                $hasil['membership']['stock']['banyak']
            ) {

                $stockRule = 'Stock Sedang';
            } else {

                $stockRule = 'Stock Banyak';
            }

            if (
                $hasil['membership']['penjualan']['tinggi'] >= max(
                    $hasil['membership']['penjualan']['sedang'],
                    $hasil['membership']['penjualan']['rendah']
                )
            ) {

                $jualRule = 'Penjualan Tinggi';
            } elseif (
                $hasil['membership']['penjualan']['sedang'] >=
                $hasil['membership']['penjualan']['rendah']
            ) {

                $jualRule = 'Penjualan Sedang';
            } else {

                $jualRule = 'Penjualan Rendah';
            }

            $rule =
                "IF {$stockRule}
AND {$jualRule}
THEN {$hasil['status']}";

            // Tambahkan data ke object product
            $product->penjualan = $penjualan;
            $product->score = $hasil['score'];
            $product->status = $hasil['status'];
            $product->membership = $hasil['membership'];

            // Data khusus untuk JavaScript
            $fuzzyData[] = [

                'nama' => $product->nama_produk,
                'kategori' => $product->category->nama_kategori,

                'stock' => $product->stock,
                'minimum' => $product->minimum_stock,
                'penjualan' => $penjualan,

                'score' => $hasil['score'],
                'status' => $hasil['status'],

                'rule' => $rule,

                'stockSedikit' => $hasil['membership']['stock']['sedikit'],
                'stockSedang' => $hasil['membership']['stock']['sedang'],
                'stockBanyak' => $hasil['membership']['stock']['banyak'],

                'jualRendah' => $hasil['membership']['penjualan']['rendah'],
                'jualSedang' => $hasil['membership']['penjualan']['sedang'],
                'jualTinggi' => $hasil['membership']['penjualan']['tinggi']

            ];
        }

        // Urutkan berdasarkan score AI
        $products = $products->sortByDesc('score');

        // Dashboard
        $jumlahRestock = $products->where('status', 'Segera Restock')->count();
        $jumlahPantau = $products->where('status', 'Perlu Dipantau')->count();
        $jumlahAman = $products->where('status', 'Stock Aman')->count();

        $chartData = [

            'Segera Restock' => $jumlahRestock,
            'Perlu Dipantau' => $jumlahPantau,
            'Stock Aman' => $jumlahAman,

        ];

        $topProducts = $products
            ->sortByDesc('score')
            ->take(10)
            ->values();

        $barChartData = [
            'labels' => $topProducts->pluck('nama_produk'),
            'scores' => $topProducts->pluck('score'),
        ];

        $trend = SaleDetail::selectRaw('DATE(created_at) as tanggal, SUM(qty) as total')
            ->groupBy('tanggal')
            ->orderBy('tanggal')
            ->take(7)
            ->get();

        $trendChart = [
            'labels' => $trend->pluck('tanggal'),
            'data' => $trend->pluck('total'),
        ];

        return view('restock.index', compact(
            'products',
            'jumlahRestock',
            'jumlahPantau',
            'jumlahAman',
            'fuzzyData',
            'barChartData',
            'chartData',
            'trendChart'
        ));
    }
}
