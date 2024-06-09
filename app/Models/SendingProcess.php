<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class SendingProcess extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'status',
        'when',
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

    public function receivers(): BelongsToMany
    {
        return $this->belongsToMany(Receiver::class, 'receiver_sending_process');
    }
}
