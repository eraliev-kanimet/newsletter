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

    protected ?array $users = null;

    protected ?bool $created_at = null;
    protected ?bool $updated_at = null;

    protected function query(): Builder
    {
        $query = Receiver::query()->with(['user']);

        if (!is_null($this->users)) {
            $query->whereIn('user_id', $this->users);
        }

        return $query;
    }

    protected function resource(mixed $result): AnonymousResourceCollection
    {
        return ReceiverResource::collection($result);
    }

    protected function generateCacheKey(): string
    {
        return sprintf(
            $this->tag . '_%s_%s_%s_%s_%s',
            $this->page,
            $this->per_page,
            $this->created_at,
            $this->updated_at,
            '(' . implode(',', $this->users) . ')',
        );
    }

    public function setParameters(array $parameters): static
    {
        parent::setParameters($parameters);

        if (!is_null($this->users)) {
            $users = convertArrayToIntegers($this->users);

            sort($users);

            $this->users = $users;
        }

        return $this;
    }
}
