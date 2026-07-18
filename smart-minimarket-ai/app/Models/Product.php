<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
}
