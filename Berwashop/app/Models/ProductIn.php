<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductIn extends Model
{
    protected $fillable = [
        'ProductCode',
        'Date',
        'Quantity',
        'UniquePrice',
        'TotalPrice',
    ];

    protected $casts = [
        'Date' => 'date',
        'UniquePrice' => 'decimal:2',
        'TotalPrice' => 'decimal:2',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'ProductCode', 'ProductCode');
    }
} 