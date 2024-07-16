<?php

namespace App\Contracts\User;

use App\Http\Resources\UserResource;
use App\Models\User;

interface ApiUserServiceInterface
{
    public function set(User $user): static;

    public function resource(): UserResource;

    public function resourceWithToken(): array;

    public function logout(): void;
}
