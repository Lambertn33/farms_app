<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    const ROLES = ['ADMIN', 'SITE_MANAGER', 'FARMER'];

    const ADMIN = self::ROLES[0];

    const SITE_MANAGER = self::ROLES[1];

    const FARMER = self::ROLES[2];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'names',
        'email',
        'role',
        'has_confirmed_password',
        'phone_no',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'id' => 'string',
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    /**
     * Get the farmer associated with the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function farmer(): HasOne
    {
        return $this->hasOne(Farmer::class, 'user_id', 'id');
    }

    /**
     * Get the manager associated with the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function manager(): HasOne
    {
        return $this->hasOne(SiteManager::class, 'user_id', 'id');
    }
}
