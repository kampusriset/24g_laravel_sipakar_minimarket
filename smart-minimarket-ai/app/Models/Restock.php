<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Restock extends Model
{
    protected $fillable = [
        'product_id',
        'supplier_id',
        'jumlah',
        'harga_beli',
        'tanggal_restock',
        'nomor_restock',
        'catatan',
    ];

    protected $casts = [
        'tanggal_restock' => 'date',
        'harga_beli' => 'decimal:2',
    ];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function supplier(): BelongsTo
    {
        return $this->belongsTo(Supplier::class);
    }
}