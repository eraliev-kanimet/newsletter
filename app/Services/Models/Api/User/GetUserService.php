<?php

namespace App\Services\Models\Api\User;

use App\Contracts\User\ApiGetUserServiceInterface;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Services\Abstract\PaginateModelWithCacheService;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class GetUserService extends PaginateModelWithCacheService implements ApiGetUserServiceInterface
{
    protected string $tag = 'api_users';

    protected array $booleans = ['is_active'];
    protected array $sorts = ['created_at', 'updated_at'];

    protected function query(): Builder
    {
        $query = User::query();

        if ($this->hasBoolean('is_active')) {
            $query->whereIsActive($this->boolean('is_active'));
        }

        return $query;
    }

    protected function resource(mixed $result): AnonymousResourceCollection
    {
        return UserResource::collection($result);
    }
}
