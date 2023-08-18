<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Farm_Season_Expense extends Model
{
    use HasFactory;

    protected $fillable = [
        'id', 'yield_id', 'type', 'product', 'quantity', 'price', 'description',
    ];

    protected $casts = [
        'id' => 'string',
        'yield_id' => 'string'
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
    public function yield(): BelongsTo
    {
        return $this->belongsTo(Farm_Season::class, 'yield_id', 'id');
    }
    
}
