<?php

namespace App\Services\Models\User;

use App\Contracts\User\UserUpdateServiceInterface;

class UserUpdateService extends UserService implements UserUpdateServiceInterface
{
    public function update(array $data): static
    {
        $this->record->update($data);

        return $this;
    }
}
