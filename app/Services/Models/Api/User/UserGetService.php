<?php

namespace App\Services\Models\Api\User;

use App\Http\Resources\UserResource;
use App\Models\User;
use App\Services\Abstract\PaginateModelWithCacheService;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class UserGetService extends PaginateModelWithCacheService
{
    protected string $tag = 'api_users';

    protected array $integers = ['page', 'per_page'];
    protected array $booleans = ['is_active'];
    protected array $sorts = ['created_at', 'updated_at'];

    protected ?bool $is_active = null;
    protected ?bool $created_at = null;
    protected ?bool $updated_at = null;

    protected function query(): Builder
    {
        $query = User::query();

        if (is_bool($this->is_active)) {
            $query->whereIsActive($this->is_active);
        }

        if (is_bool($this->created_at)) {
            $query->orderBy('created_at', $this->created_at ? 'desc' : 'asc');
        }

        if (is_bool($this->updated_at)) {
            $query->orderBy('updated_at', $this->updated_at ? 'desc' : 'asc');
        }

        return $query;
    }

    protected function resource(mixed $result): AnonymousResourceCollection
    {
        return UserResource::collection($result);
    }

    protected function generateCacheKey(): string
    {
        return sprintf(
            $this->tag . '_%s_%s_%s_%s_%s',
            $this->page,
            $this->per_page,
            $this->is_active,
            $this->created_at,
            $this->updated_at,
        );
    }
}
