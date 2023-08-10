<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SiteManager extends Model
{
    use HasFactory;

    protected $fillable = [
        'id', 'user_id'
    ];

    protected $casts = [
        'id' => 'string',
        'user_id' => 'string'
    ];

    /**
     * Get the user that owns the SiteManager
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    /**
     * Get all of the sites for the SiteManager
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function sites(): HasMany
    {
        return $this->hasMany(Site::class, 'manager_id', 'id');
    }
}
