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
        'message_id',
        'status',
        'when',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function message(): BelongsTo
    {
        return $this->belongsTo(Message::class);
    }

    public function receivers(): BelongsToMany
    {
        return $this->belongsToMany(Receiver::class, 'receiver_sending_process');
    }
}
