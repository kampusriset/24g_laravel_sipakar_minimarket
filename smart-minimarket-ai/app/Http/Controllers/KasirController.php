<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Payment;
use App\Models\Product;
use App\Models\Sale;
use App\Models\SaleDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class KasirController extends Controller
{
    /**
     * Halaman Kasir
     */
    public function index()
    {
       $categories = Category::orderBy('nama_kategori')->get();

        return view('kasir.index', compact('categories'));
    }

    /**
     * Checkout
     */
    public function checkout(Request $request)
    {
        $request->validate([
            'cart' => 'required|array|min:1',
            'total' => 'required|numeric|min:1',
            'bayar' => 'required|numeric',
        ]);

        if (!Auth::check()) {
            return response()->json([
                'success' => false,
                'message' => 'User belum login.'
            ], 401);
        }

        try {

            DB::beginTransaction();

            // Generate Invoice
            $invoice = 'INV-' . now()->format('YmdHis');

            // Simpan Sales
            $sale = Sale::create([
                'invoice_number' => $invoice,
                'user_id'        => Auth::id(),
                'tanggal'        => now(),
                'total_harga'    => $request->total,
                'status'         => 'selesai',
            ]);

            // Simpan Detail Penjualan
            foreach ($request->cart as $item) {

                $product = Product::findOrFail($item['id']);

                if ($product->stock < $item['qty']) {
                    throw new \Exception(
                        "Stock {$product->nama_produk} tidak mencukupi."
                    );
                }

                SaleDetail::create([
                    'sale_id'    => $sale->id,
                    'product_id' => $product->id,
                    'qty'        => $item['qty'],
                    'harga'      => $product->harga_jual,
                    'subtotal'   => $item['qty'] * $product->harga_jual,
                ]);

                // Kurangi Stock
                $product->stock -= $item['qty'];
                $product->save();
            }

            // Simpan Pembayaran
            Payment::create([
                'sale_id'       => $sale->id,
                'metode'        => 'cash',
                'jumlah_bayar'  => $request->bayar,
                'kembalian'     => $request->bayar - $request->total,
            ]);

            DB::commit();

            return response()->json([
                'success' => true,
                'invoice' => $invoice,
                'message' => 'Transaksi berhasil.'
            ]);
        } catch (\Throwable $e) {

            DB::rollBack();

            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
