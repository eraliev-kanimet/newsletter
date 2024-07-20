<?php

use App\Models\User;

function resource_user(User $user): array
{
    return [
        'id' => $user->id,
        'is_active' => (bool)$user->is_active,
        'uuid' => $user->uuid,
        'email' => $user->email,
        'name' => $user->name,
    ];
}
