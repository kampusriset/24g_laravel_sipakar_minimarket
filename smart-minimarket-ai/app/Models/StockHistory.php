<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StockHistory extends Model
{
    protected $fillable = [
        'product_id',
        'jenis',
        'jumlah',
        'stock_sebelum',
        'stock_sesudah',
        'keterangan',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
