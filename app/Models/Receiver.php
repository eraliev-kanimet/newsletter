<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Receiver extends Model
{
    protected $fillable = [
        'is_active',
        'user_id',
        'email',
        'data',
    ];

    protected function casts(): array
    {
        return [
            'data' => 'array',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function sendingProcesses(): BelongsToMany
    {
        return $this->belongsToMany(SendingProcess::class, 'receiver_sending_process');
    }
}
