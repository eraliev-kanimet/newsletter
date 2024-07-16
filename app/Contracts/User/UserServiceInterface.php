<?php

namespace App\Contracts\User;

use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;

interface UserServiceInterface
{
    public function get(): User;

    public function set(User $user): static;

    public function login(): void;

    public function attempt(array $data): static|false;

    /**
     * @throws ModelNotFoundException
     */
    public function findAndSet(array $attributes): static;

    public function api(): ApiUserServiceInterface;
}
