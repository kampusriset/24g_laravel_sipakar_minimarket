<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RestockPrediction extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'prediction_date',
        'fuzzy_score',
        'priority',
        'notes',
    ];

    protected $casts = [
        'prediction_date' => 'date',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
