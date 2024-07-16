<?php

namespace App\Contracts\Auth;

use App\Contracts\User\UserServiceInterface;
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

    public function send(string $email, bool $api = false): void;

    /**
     * @throws PasswordResetException
     */
    public function reset(string $token, string $password): UserServiceInterface;
}
