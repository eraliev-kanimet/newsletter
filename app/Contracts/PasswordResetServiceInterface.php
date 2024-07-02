<?php

namespace App\Contracts;

use App\Exceptions\PasswordResetException;

interface PasswordResetServiceInterface
{
    public function sendLink(string $email): void;

    public function getLink(string $token): string;

    /**
     * @throws PasswordResetException
     */
    public function reset(string $token, string $password): void;
}
