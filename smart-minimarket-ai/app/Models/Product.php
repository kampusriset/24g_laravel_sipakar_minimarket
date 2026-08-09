<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Restock;

class Product extends Model
{
    protected $fillable = [
        'kode_produk',
        'nama_produk',
        'kategori_id',
        'supplier_id',
        'harga_beli',
        'harga_jual',
        'stock',
        'minimum_stock',
        'rata_penjualan',
        'gambar',
        'deskripsi',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'kategori_id');
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    public function saleDetails()
    {
        return $this->hasMany(SaleDetail::class);
    }

    public function stockHistories()
    {
        return $this->hasMany(StockHistory::class);
    }

    public function restocks(): HasMany
    {
        return $this->hasMany(Restock::class);
    }

    protected static function booted(): void
    {
        static::creating(function (Product $product) {
            $lastProduct = Product::query()
                ->orderByDesc('id')
                ->first();

            $nextNumber = $lastProduct
                ? $lastProduct->id + 1
                : 1;

            $product->kode_produk = 'PRD-' . str_pad(
                $nextNumber,
                4,
                '0',
                STR_PAD_LEFT
            );
        });
    }
}
