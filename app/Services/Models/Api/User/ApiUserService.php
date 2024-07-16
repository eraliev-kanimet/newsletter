<?php

namespace App\Services\Models\Api\User;

use App\Contracts\User\ApiUserServiceInterface;
use App\Http\Resources\UserResource;
use App\Models\User;

class ApiUserService implements ApiUserServiceInterface
{
    protected User $record;

    public function set(User $user): static
    {
        $this->record = $user;

        return $this;
    }

    public function resource(): UserResource
    {
        return new UserResource($this->record);
    }

    public function resourceWithToken(): array
    {
        return [
            'data' => $this->resource(),
            'token' => $this->record->createToken(config('app.name'))->plainTextToken,
        ];
    }

    public function logout(): void
    {
        $this->record->tokens()->delete();
    }
}
