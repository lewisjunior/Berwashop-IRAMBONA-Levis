<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $primaryKey = 'ProductCode';
    public $incrementing = false;
    protected $keyType = 'string';
    
    protected $fillable = [
        'ProductCode',
        'ProductName',
    ];

    public function productIns()
    {
        return $this->hasMany(ProductIn::class, 'ProductCode', 'ProductCode');
    }

    public function productOuts()
    {
        return $this->hasMany(ProductOut::class, 'ProductCode', 'ProductCode');
    }
} 