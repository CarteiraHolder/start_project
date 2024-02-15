<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Settings extends Model
{
    use HasFactory;
    protected $fillable = [
        'seed_version',
        'api_geolocation',
        'clear_log_user_actions',
        'clear_all_cache',
    ];

    protected $casts = [
        'clear_all_cache' => 'boolean',
    ];
}
