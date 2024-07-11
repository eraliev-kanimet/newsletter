<?php

namespace App\Contracts\SocialAccount;

use App\Enums\SocialiteProvider;
use App\Models\SocialAccount;

interface SocialAccountServiceInterface
{
    public function find(SocialiteProvider $provider, int|string $provider_id): ?SocialAccount;

    public function create(array $data): SocialAccount;
}
