<?php

namespace App\Services;


use App\Models\Product;
use App\Models\Sale;
use App\Models\SaleDetail;
use Carbon\Carbon;
use App\Services\FuzzyService;


class DashboardService
{
    protected $fuzzy;


    public function __construct(FuzzyService $fuzzy)
    {
        $this->fuzzy = $fuzzy;
    }


    public function getDashboardData()
    {


        $totalPenjualan = Sale::sum('total_harga');


        $totalTransaksi = Sale::count();


        $stokMenipis = Product::whereColumn(
            'stock',
            '<=',
            'minimum_stock'
        )
            ->orderBy('stock')
            ->take(5)
            ->get();



        $produkTerlaris = SaleDetail::selectRaw(
            'product_id, SUM(qty) as total'
        )
            ->with('product')
            ->groupBy('product_id')
            ->orderByDesc('total')
            ->take(5)
            ->get()
            ->map(function ($item) {

                return (object)[

                    'nama_produk' =>
                    $item->product->nama_produk,

                    'total' =>
                    $item->total

                ];
            });



        $trendPenjualan = Sale::selectRaw(
            'DATE(tanggal) as tanggal,
                 SUM(total_harga) as total'
        )
            ->where(
                'tanggal',
                '>=',
                now()->subDays(7)
            )
            ->groupBy('tanggal')
            ->orderBy('tanggal')
            ->get();



        $chartLabels = $trendPenjualan
            ->pluck('tanggal')
            ->map(function ($tanggal) {

                return Carbon::parse($tanggal)
                    ->format('d M');
            });



        $chartData = $trendPenjualan
            ->pluck('total');



        // AI RESTOCK
        $ai = $this->getRestockAnalysis();



        return array_merge(

            [

                'totalPenjualan' => $totalPenjualan,

                'totalTransaksi' => $totalTransaksi,

                'stokMenipis' => $stokMenipis,

                'produkTerlaris' => $produkTerlaris,


                'chartLabels' => $chartLabels,

                'chartData' => $chartData,

            ],

            $ai

        );
    }




    public function getRestockAnalysis()
    {

        $products = Product::with(['category', 'supplier'])
            ->orderBy('nama_produk')
            ->get();

        $fuzzyData = [];

        /*
        =====================================================
        PERIODE PENJUALAN
        =====================================================
        */

        $tanggalMulai = Carbon::now()->subDays(6)->startOfDay();
        $tanggalSelesai = Carbon::now()->endOfDay();

        foreach ($products as $product) {

            /*
            =================================================
            TOTAL PENJUALAN 7 HARI TERAKHIR
            =================================================
            */

            $totalPenjualan7Hari = SaleDetail::where(
                'product_id',
                $product->id
            )
                ->whereBetween('created_at', [
                    $tanggalMulai,
                    $tanggalSelesai
                ])
                ->sum('qty');


            /*
            =================================================
            RATA-RATA PENJUALAN PER HARI
            =================================================

            Contoh:

            Senin  = 5
            Selasa = 8
            Rabu   = 7
            Kamis  = 10
            Jumat  = 6
            Sabtu  = 9
            Minggu = 11

            Total = 56

            Rata-rata harian:
            56 / 7 = 8

            =================================================
            */

            $rataPenjualanHarian = $totalPenjualan7Hari / 7;


            /*
            =================================================
            RATA-RATA PENJUALAN PER MINGGU
            =================================================

            Karena fuzzy kita sebelumnya menggunakan angka
            penjualan dalam skala mingguan, maka kita ubah
            rata-rata harian menjadi estimasi mingguan.

            Contoh:

            rata harian = 8

            8 × 7 = 56 unit/minggu

            =================================================
            */

            $rataPenjualanMingguan = $rataPenjualanHarian * 7;


            /*
            =================================================
            FUZZY CALCULATION
            =================================================
            */

            $hasil = $this->fuzzy->calculate(

                stock: $product->stock,

                minimumStock: $product->minimum_stock,

                rataPenjualan: round(
                    $rataPenjualanMingguan,
                    2
                ),

                leadTime: $product->supplier
                    ? $product->supplier->lead_time_supplier
                    : 0
            );


            /*
            =================================================
            TAMBAHKAN HASIL KE PRODUCT
            =================================================
            */

            $product->score = $hasil['score'];

            $product->status = $hasil['status'];

            $product->membership = $hasil['membership'];

            $product->rata_penjualan = round(
                $rataPenjualanMingguan,
                2
            );


            /*
            =================================================
            DATA UNTUK DETAIL AI / JAVASCRIPT
            =================================================
            */

            $fuzzyData[] = [

                'nama' => $product->nama_produk,

                'kategori' => $product->category
                    ? $product->category->nama_kategori
                    : '-',

                'stock' => $product->stock,

                'minimum' => $product->minimum_stock,

                'totalPenjualan7Hari' => $totalPenjualan7Hari,

                'rataPenjualanHarian' => round(
                    $rataPenjualanHarian,
                    2
                ),

                'rataPenjualan' => round(
                    $rataPenjualanMingguan,
                    2
                ),

                'score' => $hasil['score'],

                'status' => $hasil['status'],

                'leadTime' => $product->supplier
                    ? $product->supplier->lead_time_supplier
                    : 0,

                'rule' => $hasil['rule'],


                /*
                =============================================
                MEMBERSHIP STOCK
                =============================================
                */

                'stockSedikit' =>
                $hasil['membership']['stock']['sedikit'],

                'stockSedang' =>
                $hasil['membership']['stock']['sedang'],

                'stockBanyak' =>
                $hasil['membership']['stock']['banyak'],


                /*
                =============================================
                MEMBERSHIP PENJUALAN
                =============================================
                */

                'jualRendah' =>
                $hasil['membership']['penjualan']['rendah'],

                'jualSedang' =>
                $hasil['membership']['penjualan']['sedang'],

                'jualTinggi' =>
                $hasil['membership']['penjualan']['tinggi'],


                /*
                =============================================
                MEMBERSHIP LEAD TIME
                =============================================
                */

                'leadCepat' =>
                $hasil['membership']['leadTime']['cepat'],

                'leadSedang' =>
                $hasil['membership']['leadTime']['sedang'],

                'leadLama' =>
                $hasil['membership']['leadTime']['lama'],
            ];
        }


        /*
        =========================================================
        URUTKAN BERDASARKAN SCORE AI
        =========================================================
        */

        $products = $products
            ->sortByDesc('score')
            ->values();


        /*
        =========================================================
        JUMLAH STATUS
        =========================================================
        */

        $jumlahRestock = $products
            ->where('status', 'Segera Restock')
            ->count();

        $jumlahPantau = $products
            ->where('status', 'Perlu Dipantau')
            ->count();

        $jumlahAman = $products
            ->where('status', 'Stock Aman')
            ->count();


        /*
        =========================================================
        DATA PIE / STATUS CHART
        =========================================================
        */

        $restokchartData = [

            'Segera Restock' => $jumlahRestock,

            'Perlu Dipantau' => $jumlahPantau,

            'Stock Aman' => $jumlahAman,

        ];


        /*
        =========================================================
        TOP 10 PRODUK BERDASARKAN SCORE
        =========================================================
        */

        $topProducts = $products
            ->sortByDesc('score')
            ->take(10)
            ->values();


        $barChartData = [

            'labels' => $topProducts
                ->pluck('nama_produk')
                ->values(),

            'scores' => $topProducts
                ->pluck('score')
                ->values(),

        ];


        /*
        =========================================================
        TREND PENJUALAN 7 HARI TERAKHIR
        =========================================================
        */

        $trend = SaleDetail::selectRaw(
            'DATE(created_at) as tanggal,
                 SUM(qty) as total'
        )
            ->whereBetween('created_at', [
                $tanggalMulai,
                $tanggalSelesai
            ])
            ->groupBy('tanggal')
            ->orderBy('tanggal')
            ->get();


        /*
        =========================================================
        DATA TREND CHART
        =========================================================
        */

        $trendChart = [

            'labels' => $trend
                ->pluck('tanggal')
                ->values(),

            'data' => $trend
                ->pluck('total')
                ->values(),

        ];


        /*
        =========================================================
        RETURN
        =========================================================
        */

        return [

            'products' => $products,

            'jumlahRestock' => $jumlahRestock,

            'jumlahPantau' => $jumlahPantau,

            'jumlahAman' => $jumlahAman,

            'restokchartData' => $restokchartData,

            'barChartData' => $barChartData,

            'trendChart' => $trendChart,

            'fuzzyData' => $fuzzyData,

        ];
    }
}
