<?php

namespace App\Contracts\User;

use App\Models\User;

interface UserServiceInterface
{
    public function set(User $user): static;

    public function login(): void;

    public function attempt(array $data): static|false;
}
