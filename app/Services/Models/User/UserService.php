<?php

namespace App\Services\Models\User;

use App\Contracts\User\UserServiceInterface;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserService implements UserServiceInterface
{
    protected User $record;

    public function set(User $user): static
    {
        $this->record = $user;

        return $this;
    }

    public function login(): void
    {
        Auth::login($this->record);
    }

    public function attempt(array $data): static|false
    {
        if (Auth::attempt($data)) {
            return $this->set(Auth::user());
        }

        return false;
    }
}
