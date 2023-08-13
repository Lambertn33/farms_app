<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Season_Expense extends Model
{
    use HasFactory;

    protected $fillable = [
        'id', 'season_id', 'type', 'product', 'quantity', 'price', 'description',
    ];

    protected $casts = [
        'id' => 'string',
        'season_id' => 'string'
    ];

    const EXPENSES_TYPES = [
        'LABOUR', 'FERTILIZER', 'MANURE', 'PESTICIDE'
    ];

    const LABOUR = self::EXPENSES_TYPES[0];
    const FERTILIZER = self::EXPENSES_TYPES[1];
    const MANURE = self::EXPENSES_TYPES[2];
    const PESTICIDE = self::EXPENSES_TYPES[3];

    /**
     * Get the season that owns the Season_Expense
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function season(): BelongsTo
    {
        return $this->belongsTo(Season::class, 'season_id', 'id');
    }
}
