<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;


class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::with(['category', 'supplier'])
            ->orderBy('nama_produk');

        // Pencarian produk
        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('nama_produk', 'like', "%{$search}%")
                    ->orWhere('kode_produk', 'like', "%{$search}%");
            });
        }

        // Filter kategori
        if ($request->filled('kategori')) {
            $query->where('kategori_id', $request->kategori);
        }

        $products = $query->paginate(10)->withQueryString();

        // Statistik produk
        $totalProduk = Product::count();

        $stockAman = Product::whereColumn(
            'stock',
            '>',
            'minimum_stock'
        )->count();

        $stockMenipis = Product::whereColumn(
            'stock',
            '<=',
            'minimum_stock'
        )->count();

        // Data kategori untuk filter
        $categories = \App\Models\Category::orderBy(
            'nama_kategori'
        )->get();

        return view('products.index', compact(
            'products',
            'totalProduk',
            'stockAman',
            'stockMenipis',
            'categories'
        ));
    }

    public function search(Request $request)
    {
        $query = Product::with('category')
            ->where('stock', '>', 0);


        // Filter nama produk
        if ($request->filled('q')) {

            $search = $request->q;

            $query->where(function ($q) use ($search) {

                $q->where('nama_produk', 'like', "%{$search}%")
                    ->orWhere('kode_produk', 'like', "%{$search}%");
            });
        }


        // Filter kategori
        if ($request->filled('category_id')) {

            $query->where(
                'kategori_id',
                $request->category_id
            );
        }


        $products = $query
            ->limit(20)
            ->get();


        return response()->json($products);
    }
}
