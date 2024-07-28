<?php

namespace App\Enums;

use App\Models\User;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

enum SocialiteProvider: int
{
    case github = 1;
    case google = 2;

    public static function key(?string $key = null): self
    {
        foreach (self::cases() as $case) {
            if ($case->name == $key) {
                return $case;
            }
        }

        throw new NotFoundHttpException;
    }

    public static function keys(): array
    {
        $keys = [];

        foreach (self::cases() as $case) {
            $keys[] = $case->name;
        }

        return $keys;
    }

    public static function dataForAdmin(User $user): array
    {
        $array = [
            'github' => false,
            'google' => false,
        ];

        foreach ($user->socialAccounts->pluck('provider') as $provider) {
            $array[self::from($provider)->name] = true;
        }

        return $array;
    }
}
