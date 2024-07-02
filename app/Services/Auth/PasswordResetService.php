<?php

namespace App\Services\Auth;

use App\Contracts\PasswordResetServiceInterface;
use App\Mail\PasswordResetMail;
use App\Models\PasswordResetToken;
use App\Models\User;
use App\Services\Abstract\Service;
use Illuminate\Support\Facades\Mail;

class PasswordResetService extends Service implements PasswordResetServiceInterface
{
    public function sendLink(string $email): void
    {
        if (User::whereEmail($email)->exists()) {
            $token = sha1($email);

            PasswordResetToken::updateOrCreate([
                'email' => $email,
            ],[
                'email' => $email,
                'token' => $token,
            ]);

            $resetLink = $this->getLink($token);

            Mail::to($email)->send(new PasswordResetMail($resetLink));
        }
    }

    public function getLink(string $token): string
    {
        return route('auth.password-reset.page', ['token' => $token]);
    }
}
