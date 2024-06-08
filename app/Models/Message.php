<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Message extends Model
{
    protected $fillable = [
        'user_id',
        'subject',
        'message',
    ];

    protected function casts(): array
    {
        return [
            'message' => 'array',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function sendingProcesses(): HasMany
    {
        return $this->hasMany(SendingProcess::class);
    }
}
