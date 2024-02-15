<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class City extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'state',
        'uf',
    ];

    function contractor(): HasMany
    {
        return $this->hasMany(Contractor::class);
    }
    function pdv(): HasMany
    {
        return $this->hasMany(Pdv::class);
    }
}
