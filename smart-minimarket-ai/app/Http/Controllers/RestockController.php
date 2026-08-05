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
        $products = Product::with(['category', 'supplier'])
            ->orderBy('nama_produk')
            ->get();

        $fuzzyData = [];

        foreach ($products as $product) {

            $rataPenjualan = SaleDetail::where('product_id', $product->id)
                ->selectRaw('SUM(qty) / 4 as rata')
                ->value('rata') ?? 0;

            $hasil = $this->fuzzy->calculate(

                stock: $product->stock,
                minimumStock: $product->minimum_stock,
                rataPenjualan: round($rataPenjualan, 2),
                leadTime: $product->supplier->lead_time_supplier
            );


            // Tambahkan data ke object product
            $product->rata_penjualan = round($rataPenjualan,2);
            $product->score = $hasil['score'];
            $product->status = $hasil['status'];
            $product->membership = $hasil['membership'];

            // Data khusus untuk JavaScript
            $fuzzyData[] = [

                'nama' => $product->nama_produk,
                'kategori' => $product->category->nama_kategori,

                'stock' => $product->stock,
                'minimum' => $product->minimum_stock,
                'rataPenjualan' => round($rataPenjualan,2),
                'score' => $hasil['score'],
                'status' => $hasil['status'],

                'leadTime' => $product->supplier->lead_time_supplier,
                'rule' => $hasil['rule'],

                'stockSedikit' => $hasil['membership']['stock']['sedikit'],
                'stockSedang' => $hasil['membership']['stock']['sedang'],
                'stockBanyak' => $hasil['membership']['stock']['banyak'],

                'jualRendah' => $hasil['membership']['penjualan']['rendah'],
                'jualSedang' => $hasil['membership']['penjualan']['sedang'],
                'jualTinggi' => $hasil['membership']['penjualan']['tinggi'],

                'leadCepat'  => $hasil['membership']['leadTime']['cepat'],
                'leadSedang' => $hasil['membership']['leadTime']['sedang'],
                'leadLama'   => $hasil['membership']['leadTime']['lama']
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
