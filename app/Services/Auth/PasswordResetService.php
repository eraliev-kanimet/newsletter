<?php

namespace App\Services\Auth;

use App\Contracts\Auth\PasswordResetServiceInterface;
use App\Contracts\Mail\MailServiceInterface;
use App\Contracts\User\UserServiceInterface;
use App\Exceptions\PasswordResetException;
use App\Mail\PasswordResetMail;
use App\Models\PasswordResetToken;
use App\Models\User;

class PasswordResetService implements PasswordResetServiceInterface
{
    public function __construct(
        protected MailServiceInterface $mailService
    )
    {
        //
    }

    public function findByToken(string $token): ?PasswordResetToken
    {
        return PasswordResetToken::whereToken($token)->first();
    }

    public function findOrFailByToken(string $token): PasswordResetToken
    {
        return PasswordResetToken::whereToken($token)->firstOrFail();
    }

    public function send(string $email, bool $api = false): void
    {
        if (User::whereEmail($email)->exists()) {
            $token = md5(uniqid(rand(), true));

            PasswordResetToken::updateOrCreate([
                'email' => $email,
            ], [
                'token' => $token,
            ]);

            if ($api) {
                $link = url('app/password-reset?token=' . $token);
            } else {
                $link = route('auth.password-reset.page', ['token' => $token]);
            }

            $this->mailService
                ->to($email)
                ->setMailable(new PasswordResetMail($link))
                ->send();
        }
    }

    public function reset(string $token, string $password): UserServiceInterface
    {
        $resetToken = $this->findByToken($token);

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

        $resetToken->delete();

        /** @var UserServiceInterface $service */
        $service = app(UserServiceInterface::class);

        return $service->set($user);
    }
}
