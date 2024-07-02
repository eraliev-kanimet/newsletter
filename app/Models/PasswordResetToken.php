<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PasswordResetToken extends Model
{
    protected $primaryKey = 'email';
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = [
        'email',
        'token',
        'created_at',
    ];

    protected function casts(): array
    {
        return [
            'created_at' => 'datetime',
        ];
    }

    protected static function boot(): void
    {
        parent::boot();

        self::saving(function (self $model) {
            $model->created_at = now();
        });
    }

    public function isExpired(int $minutes = 30): bool
    {
        return $this->created_at->addMinutes($minutes)->isPast();
    }
}
