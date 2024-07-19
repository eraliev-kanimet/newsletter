<?php

namespace App\Services\Abstract;

use App\Contracts\Abstract\ModelWithCacheServiceInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Cache;

abstract class ModelWithCacheService implements ModelWithCacheServiceInterface
{
    protected int $minute = 360;

    protected string $tag;

    protected array $variables = [];
    protected array $booleans = [];
    protected array $integers = [];
    protected array $sorts = [];

    protected function generateCacheKey(): string
    {
        $data = [
            'variables' => $this->variables,
            'booleans' => $this->booleans,
            'integers' => $this->integers,
            'sorts' => $this->sorts,
        ];

        return md5(json_encode(array_filter($data, fn ($value) => !empty($value))));
    }

    abstract protected function query(): Builder;

    abstract protected function result(): AnonymousResourceCollection;

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

    public function setParameters(array $parameters): static
    {
        $arr = [
            'variables' => $this->variables,
            'booleans' => $this->booleans,
            'sorts' => $this->sorts,
            'integers' => $this->integers,
        ];

        foreach ($arr as $property => $keys) {
            $filteredValues = [];

            foreach ($keys as $key) {
                if (isset($parameters[$key])) {
                    $value = $parameters[$key];

                    if (is_array($value)) {
                        if (count($value)) {
                            sort($value);

                            $filteredValues[$key] = $value;
                        }
                    } else {
                        $filteredValues[$key] = $value;
                    }
                }
            }

            $this->{$property} = $filteredValues;
        }

        return $this;
    }

    protected function sort(Builder $query): Builder
    {
        $sorts = convertArrayToIntegers($this->sorts);

        $this->sorts = $sorts;

        foreach ($sorts as $key => $value) {
            $query->orderBy($key, $value ? 'desc' : 'asc');
        }

        return $query;
    }

    protected function hasVariable(string $key): bool
    {
        return isset($this->variables[$key]);
    }

    protected function variable(string $key): string|array
    {
        return $this->variables[$key];
    }

    protected function hasInteger(string $key): bool
    {
        return isset($this->integers[$key]);
    }

    protected function integer(string $key, int $default): int
    {
        return $this->hasInteger($key) ? (int)$this->integers[$key] : $default;
    }

    protected function hasBoolean(string $key): bool
    {
        return isset($this->booleans[$key]);
    }

    protected function boolean(string $key): bool
    {
        return (bool)$this->booleans[$key];
    }
}
