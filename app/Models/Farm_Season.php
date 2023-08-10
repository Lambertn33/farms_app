<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Farm_Season extends Model
{
    use HasFactory;

    protected $fillable = [
        'farmer_id', 'season_id', 'year', 'yield'
    ];

    protected $casts = [
        'farmer_id' => 'string',
        'season_id' =>'string'
    ];
}
