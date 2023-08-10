<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Farm extends Model
{
    use HasFactory;

    protected $fillable = [
        'id', 'site_id', 'farmer_id', 'size'
    ];

    protected $casts = [
        'id' => 'string',
        'site_id' => 'string',
        'farmer_id' => 'string'
    ];

    /**
     * Get the farmer that owns the Farm
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function farmer(): BelongsTo
    {
        return $this->belongsTo(Farmer::class, 'farmer_id', 'id');
    }

    /**
     * Get the site that owns the Farm
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function site(): BelongsTo
    {
        return $this->belongsTo(Site::class, 'site_id', 'id');
    }

    /**
     * The seasons that belong to the Farm
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function seasons(): BelongsToMany
    {
        return $this->belongsToMany(Season::class, 'farm__seasons', 'farmer_id', 'season_id')->withPivot('year', 'yield');
    }
}
