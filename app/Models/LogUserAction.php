<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LogUserAction extends Model
{
    use HasFactory;

    protected $fillable = [
        'event',
        'table',
        'old_data',
        'new_data',
        'register_id',
        'user_id',
    ];

    protected $casts = [
        'old_data' => 'json',
        'new_data' => 'json',
    ];
}
