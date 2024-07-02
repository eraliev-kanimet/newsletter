<?php

namespace App\Services\Auth;

use App\Contracts\PasswordResetServiceInterface;
use App\Exceptions\PasswordResetException;
use App\Mail\PasswordResetMail;
use App\Models\PasswordResetToken;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class PasswordResetService implements PasswordResetServiceInterface
{
    public function sendLink(string $email): void
    {
        if (User::whereEmail($email)->exists()) {
            $token = sha1($email);

            PasswordResetToken::updateOrCreate([
                'email' => $email,
            ], [
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

    public function reset(string $token, string $password): void
    {
        $resetToken = PasswordResetToken::whereToken($token)->first();

        if (!$resetToken) {
            throw new PasswordResetException;
        }

        if ($resetToken->isExpired()) {
            throw new PasswordResetException;
        }

        $user = User::whereEmail($resetToken->email)->first();

        if (!$user) {
            throw new PasswordResetException;
        }

        $user->update([
            'password' => $password,
        ]);

        Auth::login($user);

        $resetToken->delete();
    }
}
