<?php

namespace App\Services\Models\User;

use App\Models\User;
use Illuminate\Support\Str;

class UserModifyService extends UserService
{
    public static function create(array $data, int $role = 1): static
    {
        $data['roles'] = [$role];

        if (empty($data['password'])) {
            $data['password'] = Str::random(8);
        }

        return new static(User::create($data));
    }
}
