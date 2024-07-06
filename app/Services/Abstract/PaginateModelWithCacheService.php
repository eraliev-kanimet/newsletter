<?php

namespace App\Services\Abstract;

use App\Contracts\Abstract\PaginateModelWithCacheServiceInterface;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

abstract class PaginateModelWithCacheService extends ModelWithCacheService implements PaginateModelWithCacheServiceInterface
{
    abstract protected function resource(mixed $result): AnonymousResourceCollection;

    protected int $page = 0;
    protected int $per_page = 15;

    protected array $integers = ['page', 'per_page'];

    protected function result(): AnonymousResourceCollection
    {
        if ($this->page) {
            $result = $this->query()->paginate($this->per_page)->withQueryString();
        } else {
            $result = $this->query()->limit($this->per_page)->get();
        }

        return $this->resource($result);
    }

    protected function generateCacheKey(): string
    {
        return sprintf(
            $this->tag . '_%s_%s',
            $this->page,
            $this->per_page,
        );
    }
}
