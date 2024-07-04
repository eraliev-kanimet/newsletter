<?php

namespace App\Services\Abstract;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Cache;

abstract class ModelWithCacheService extends Service
{
    protected int $minute = 360;

    protected string $tag;

    protected array $booleans = [];
    protected array $integers = [];

    abstract protected function query(): Builder;

    abstract protected function result(): AnonymousResourceCollection;

    abstract protected function generateCacheKey(): string;

    public function get(): AnonymousResourceCollection
    {
        if (config('cache.default') == 'redis') {
            $key = $this->generateCacheKey();

            if (Cache::tags($this->tag)->has($key)) {
                return Cache::tags($this->tag)->get($key);
            }

            $result = $this->result();

            Cache::tags($this->tag)->put($key, $result, now()->addMinutes($this->minute));

            return $result;
        }

        return $this->result();
    }

    protected function setParameters(array $parameters): void
    {
        foreach ($this->booleans as $value) {
            $this->{$value} = isset($parameters[$value]) && $parameters[$value];
        }

        foreach ($this->integers as $value) {
            if (isset($parameters[$value])) {
                $this->{$value} = (int)$parameters[$value];
            }
        }
    }
}
