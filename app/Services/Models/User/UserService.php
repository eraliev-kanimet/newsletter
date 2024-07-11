<?php

namespace App\Services\Models\User;

use App\Contracts\User\UserServiceInterface;
use App\Models\SocialAccount;
use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Auth;

class UserService implements UserServiceInterface
{
    protected User $record;

    public function get(): User
    {
        return $this->record;
    }

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

    public function findAndSet(array $attributes): static
    {
        $query = User::query();

        foreach ($attributes as $key => $value) {
            $query->where($key, $value);
        }

        $user = $query->first();

        if ($user) {
            return $this->set($user);
        }

        throw new ModelNotFoundException;
    }
}
