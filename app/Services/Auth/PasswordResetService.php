<?php

namespace App\Services\Auth;

use App\Contracts\PasswordResetServiceInterface;
use App\Mail\ResetPasswordMail;
use App\Models\PasswordResetToken;
use App\Models\User;
use App\Services\Abstract\Service;
use Illuminate\Support\Facades\Mail;

class PasswordResetService extends Service implements PasswordResetServiceInterface
{
    public function sendResetLink(string $email): void
    {
        if (User::whereEmail($email)->exists()) {
            $token = sha1($email);

            PasswordResetToken::updateOrCreate([
                'email' => $email,
            ],[
                'email' => $email,
                'token' => $token,
            ]);

            $resetLink = $this->getResetLink($token);

            Mail::to($email)->send(new ResetPasswordMail($resetLink));
        }
    }

    public function getResetLink(string $token): string
    {
        return '/';
    }
}
