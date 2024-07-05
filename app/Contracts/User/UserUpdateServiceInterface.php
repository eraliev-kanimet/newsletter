<?php

namespace App\Contracts\User;

interface UserUpdateServiceInterface extends UserServiceInterface
{
    public function update(array $data): static;
}
