<?php

namespace App\Models;

use App\Enums\RoleEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    use SoftDeletes;

    protected $fillable = [
        'name',
        'email',
        'password',
        'cpf',
        'profile_photo',
        'active',
        'contractor_id',
        'flag_id',
        'industry_id',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'active' => 'boolean',
    ];

    // Roles
    public function hasPermission(RoleEnum $checkRole): bool
    {
        return $this->role->role->value == $checkRole->value;
    }

    // Relations
    public function contractor(): BelongsTo
    {
        return $this->belongsTo(Contractor::class);
    }

    public function industry(): BelongsTo
    {
        return $this->belongsTo(Industry::class);
    }

    public function flag(): BelongsTo
    {
        return $this->belongsTo(Flag::class);
    }

    public function logAccess(): HasMany
    {
        return $this->hasMany(LogAccess::class);
    }

    public function role(): HasOne
    {
        return $this->hasOne(Role::class);
    }
}
