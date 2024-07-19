<?php

namespace App\Services\Models\Api\Receiver;

use App\Contracts\Receiver\ApiGetReceiverServiceInterface;
use App\Http\Resources\ReceiverResource;
use App\Models\Receiver;
use App\Services\Abstract\PaginateModelWithCacheService;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class GetReceiverService extends PaginateModelWithCacheService implements ApiGetReceiverServiceInterface
{
    protected string $tag = 'api_receivers';

    protected array $variables = ['users'];
    protected array $sorts = ['created_at', 'updated_at'];

    protected function query(): Builder
    {
        $query = Receiver::query()->with(['user']);

        if ($this->hasVariable('users')) {
            $users = convertArrayToIntegers($this->variable('users'));

            $query->whereIn('user_id', $users);
        }

        return $query;
    }

    protected function resource(mixed $result): AnonymousResourceCollection
    {
        return ReceiverResource::collection($result);
    }
}
