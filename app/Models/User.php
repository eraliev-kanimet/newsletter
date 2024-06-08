<?php

namespace App\Models;

use App\Traits\Models\UserTrait;
use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;

class User extends Authenticatable implements FilamentUser
{
    use Notifiable, UserTrait;

    protected $fillable = [
        'is_active',
        'uuid',
        'email',
        'name',
        'password',
        'roles',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'password' => 'hashed',
            'roles' => 'array',
        ];
    }

    public function canAccessPanel(Panel $panel): bool
    {
        return $this->isRole();
    }

    protected static function boot(): void
    {
        parent::boot();

        self::creating(function (self $user) {
            $user->uuid = Str::uuid();
        });

        self::saving(function (self $user) {
            if ($user->isDirty('roles')) {
                $user->roles = convertArrayToIntegers($user->roles);
            }
        });
    }

    public function receivers(): HasMany
    {
        return $this->hasMany(Receiver::class);
    }

    public function messages(): HasMany
    {
        return $this->hasMany(Message::class);
    }
}
