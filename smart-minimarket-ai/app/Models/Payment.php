<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        'sale_id',
        'metode',
        'jumlah_bayar',
        'kembalian',
    ];

    public function sale()
    {
        return $this->belongsTo(Sale::class);
    }
    
}
