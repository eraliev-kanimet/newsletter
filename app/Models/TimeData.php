<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TimeData extends Model
{
    protected $fillable = [
        'type',
        'token',
        'data',
    ];

    protected function casts(): array
    {
        return [
            'data' => 'array',
        ];
    }
}
