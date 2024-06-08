<?php

namespace App\Traits\Models;

use App\Models\Message;
use App\Models\Receiver;
use App\Models\SendingProcess;
use Illuminate\Database\Eloquent\Relations\HasMany;

trait UserTrait
{
    public function isRole(int $role = 1): bool
    {
        return in_array($role, $this->roles);
    }

    public function receivers(): HasMany
    {
        return $this->hasMany(Receiver::class);
    }

    public function messages(): HasMany
    {
        return $this->hasMany(Message::class);
    }

    public function sendingProcesses(): HasMany
    {
        return $this->hasMany(SendingProcess::class);
    }
}
