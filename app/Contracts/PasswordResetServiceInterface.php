<?php

namespace App\Contracts;

interface PasswordResetServiceInterface
{
    public function sendLink(string $email): void;

    public function getLink(string $token): string;
}
