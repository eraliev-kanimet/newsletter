<?php

namespace App\Contracts\User;

use App\Exceptions\UserCreationOrderException;

interface UserCreateServiceInterface
{
    public function execute(array $data): UserServiceInterface;

    public function placeOrder(array $data, bool $api = false): void;

    /**
     * @throws UserCreationOrderException
     */
    public function withOrder(string|int $id): UserServiceInterface;
}
