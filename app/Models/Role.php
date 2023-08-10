<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Role extends Model
{
    use HasFactory;

    const ROLES = ['ADMIN', 'SITE_MANAGER', 'FARMER'];

    const ADMIN = self::ROLES[0];

    const SITE_MANAGER = self::ROLES[1];

    const FARMER = self::ROLES[2];

    protected $fillable = [
        'id', 'role'
    ];

    protected $casts = [
        'id' => 'string'
    ];

    /**
     * Get all of the users for the Role
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function users(): HasMany
    {
        return $this->hasMany(User::class, 'role_id', 'id');
    }
}
