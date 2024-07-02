<?php

namespace App\Contracts;

interface PasswordResetServiceInterface
{
    public function sendResetLink(string $email): void;

    public function getResetLink(string $token): string;
}
