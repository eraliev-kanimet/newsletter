<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PasswordResetToken extends Model
{
    protected $fillable = [
        'email',
        'token',
        'created_at',
    ];

    public $timestamps = false;

    protected static function boot(): void
    {
        parent::boot();

        self::saving(function (self $model) {
            $model->created_at = now();
        });
    }
}
