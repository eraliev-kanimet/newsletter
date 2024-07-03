<?php

namespace App\Contracts\Auth;

use App\Exceptions\PasswordResetException;
use App\Models\PasswordResetToken;
use Illuminate\Database\Eloquent\ModelNotFoundException;

interface PasswordResetServiceInterface
{
    public function findByToken(string $token): ?PasswordResetToken;

    /**
     * @throws ModelNotFoundException
     */
    public function findOrFailByToken(string $token): PasswordResetToken;

    public function send(string $email): void;

    /**
     * @throws PasswordResetException
     */
    public function reset(string $token, string $password): void;
}
