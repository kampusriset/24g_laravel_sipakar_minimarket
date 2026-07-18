<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function search(Request $request)
    {
        $keyword = $request->q;

        $products = Product::with('category')
            ->where('stock', '>', 0)
            ->where(function ($query) use ($keyword) {
                $query->where('nama_produk', 'like', "%{$keyword}%")
                      ->orWhere('kode_produk', 'like', "%{$keyword}%");
            })
            ->orderBy('nama_produk')
            ->limit(10)
            ->get();

        return response()->json($products);
    }
}

