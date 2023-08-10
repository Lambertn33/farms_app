<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Site extends Model
{
    use HasFactory;

    const LAND_TYPES = ['TYPE_1', 'TYPE_2'];

    protected $fillable = [
        'id', 'manager_id', 'land_type', 'size'
    ];

    protected $casts = [
        'id' => 'string',
        'manager_id' => 'string'
    ];

    /**
     * Get the manager that owns the Site
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function manager(): BelongsTo
    {
        return $this->belongsTo(SiteManager::class, 'manager_id', 'id');
    }

    /**
     * Get all of the farms for the Site
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function farms(): HasMany
    {
        return $this->hasMany(Farm::class, 'site_id', 'id');
    }
}
