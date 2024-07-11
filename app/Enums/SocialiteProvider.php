<?php

namespace App\Enums;

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
}
