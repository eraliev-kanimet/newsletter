<?php

namespace App\Services\Abstract;

use App\Contracts\Abstract\PaginateModelWithCacheServiceInterface;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

abstract class PaginateModelWithCacheService extends ModelWithCacheService implements PaginateModelWithCacheServiceInterface
{
    abstract protected function resource(mixed $result): AnonymousResourceCollection;

    protected array $integers = ['page', 'per_page'];

    protected function result(): AnonymousResourceCollection
    {
        $query = $this->sort($this->query());

        if ($this->hasInteger('page')) {
            $result = $query->paginate($this->integer('per_page', 15))->withQueryString();
        } else {
            $result = $query->limit($this->integer('per_page', 15))->get();
        }

        return $this->resource($result);
    }
}
