<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Farm_Season extends Model
{
    use HasFactory;

    const PRODUCTS = ['BEANS', 'MAIZE', 'SOJA BEAN'];

    const BEANS = self::PRODUCTS[0];

    const MAIZE = self::PRODUCTS[1];

    const SOYA = self::PRODUCTS[2];

    protected $fillable = [
        'farmer_id', 'season_id', 'year', 'yield', 'product'
    ];

    protected $casts = [
        'farmer_id' => 'string',
        'season_id' => 'string'
    ];
}
