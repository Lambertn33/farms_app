<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Site extends Model
{
    use HasFactory;

    const LAND_TYPES = ['SANDY', 'SILT', 'CLAY', 'LOAMY'];

    const SANDY_SOIL = self::LAND_TYPES[0];
    const SILT_SOIL = self::LAND_TYPES[1];
    const CLAY_SOIL = self::LAND_TYPES[2];
    const LOAMY_SOIL = self::LAND_TYPES[3];

    protected $fillable = [
        'id', 'manager_id', 'land_type', 'size', 'name'
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
