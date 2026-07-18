<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Supplier extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_supplier',
        'alamat',
        'telepon',
        'email',
        'lead_time_supplier',
    ];

    public function products()
    {
        return $this->hasMany(Product::class, 'supplier_id');
    }
}
