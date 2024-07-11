<?php

namespace App\Services\Models\SocialAccount;

use App\Contracts\SocialAccount\SocialAccountServiceInterface;
use App\Enums\SocialiteProvider;
use App\Models\SocialAccount;

class SocialAccountService implements SocialAccountServiceInterface
{
    public function find(SocialiteProvider $provider, int|string $provider_id): ?SocialAccount
    {
        return SocialAccount::whereProvider($provider->value)->whereProviderId($provider_id)->first();
    }

    public function create(array $data): SocialAccount
    {
        return SocialAccount::create($data);
    }
}
