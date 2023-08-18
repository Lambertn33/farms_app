<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Farm_Season_Income extends Model
{
    use HasFactory;

    const INCOME_TYPES = [
        'MARKET', 'COOPERATIVE'
    ];

    const MARKET = self::INCOME_TYPES[0];

    const COOPERATIVE = self::INCOME_TYPES[1];

    protected $fillable = [
        'id', 'yield_id', 'type', 'quantity', 'price', 'description',
    ];

    protected $casts = [
        'id' => 'string',
        'yield_id' => 'string'
    ];

    /**
     * Get the season that owns the Season_Income
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function yield(): BelongsTo
    {
        return $this->belongsTo(Farm_Season::class, 'yield_id', 'id');
    }
}
