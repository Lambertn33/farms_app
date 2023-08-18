<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Farm_Season extends Model
{
    use HasFactory;

    const PRODUCTS = ['BEANS', 'MAIZE', 'SOJA BEAN'];

    const BEANS = self::PRODUCTS[0];

    const MAIZE = self::PRODUCTS[1];

    const SOYA = self::PRODUCTS[2];

    protected $fillable = [
        'id', 'farm_id', 'season_id', 'year', 'yield', 'product'
    ];

    protected $casts = [
        'id' => 'string',
        'farm_id' => 'string',
        'season_id' => 'string'
    ];

    /**
     * Get all of the incomes for the Farm_Season
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function incomes(): HasMany
    {
        return $this->hasMany(Farm_Season_Income::class, 'yield_id', 'id');
    }

    /**
     * Get all of the expenses for the Farm_Season
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function expenses(): HasMany
    {
        return $this->hasMany(Farm_Season_Expense::class, 'yield_id', 'id');
    }
}
