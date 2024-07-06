<?php

namespace App\Contracts\Abstract;

use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

interface ModelWithCacheServiceInterface
{
    public function get(): AnonymousResourceCollection;

    public function setParameters(array $parameters): static;
}
