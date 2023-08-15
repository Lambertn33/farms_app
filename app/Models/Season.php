<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Season extends Model
{
    use HasFactory;

    protected $fillable = [
        'id', 'season'
    ];

    protected $casts = [
        'id' => 'string'
    ];

    /**
     * The farms that belong to the Season
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function yields(): BelongsToMany
    {
        return $this->belongsToMany(Farm::class, 'farm__seasons', 'season_id', 'farm_id')->withPivot('year', 'yield');
    }

    /**
     * Get all of the incomes for the Season
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function incomes(): HasMany
    {
        return $this->hasMany(Season_Income::class, 'season_id', 'id');
    }

    /**
     * Get all of the expenses for the Season
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function expenses(): HasMany
    {
        return $this->hasMany(Season_Expense::class, 'season_id', 'id');
    }
}
