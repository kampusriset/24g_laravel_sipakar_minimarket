<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\SaleDetail;
use App\Services\FuzzyService;

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

        foreach ($products as $product) {

            $penjualan = SaleDetail::where('product_id', $product->id)
                ->sum('qty');

            $hasil = $this->fuzzy->calculate(
                $product->stock,
                $product->minimum_stock,
                $penjualan
            );

            $product->penjualan = $penjualan;
            $product->score = $hasil['score'];
            $product->status = $hasil['status'];
            $product->membership = $hasil['membership'];
        }

        $products = $products->sortByDesc('score');

        return view('restock.index', compact('products'));
    }
}
