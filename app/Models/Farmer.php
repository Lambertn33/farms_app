<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Farmer extends Model
{
    use HasFactory;

    const MARITAL_STATUS = [
        'SINGLE', 'MARRIED', 'DIVORCED'
    ];

    const GENDER = [
        'MALE',
        'FEMALE'
    ];

    protected $fillable = [
        'id', 'user_id', 'DOB', 'gender', 'family_members', 'marital_status'
    ];

    protected $casts = [
        'id' => 'string',
        'user_id' => 'string'
    ];

    /**
     * Get the user that owns the Farmer
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    /**
     * Get all of the farms for the Farmer
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function farms(): HasMany
    {
        return $this->hasMany(Farm::class, 'farmer_id', 'id');
    }
}
