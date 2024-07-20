<?php

namespace App\Services\Models\Api\SendingProcess;

use App\Contracts\SendingProcess\ApiGetSendingProcessServiceInterface;
use App\Http\Resources\SendingProcessResource;
use App\Models\SendingProcess;
use App\Services\Abstract\PaginateModelWithCacheService;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class GetSendingProcessService extends PaginateModelWithCacheService implements ApiGetSendingProcessServiceInterface
{
    protected string $tag = 'api_sending_process';

    protected array $variables = ['users', 'status'];

    protected array $sorts = ['created_at', 'updated_at'];

    protected function query(): Builder
    {
        $query = SendingProcess::query();

        foreach (['user_id' => 'users', 'status' => 'status'] as $column => $value) {
            if ($this->hasVariable($value)) {
                $query->whereIn($column, convertArrayToIntegers($this->variable($value)));
            }
        }

        return $query;
    }

    protected function resource(mixed $result): AnonymousResourceCollection
    {
        return SendingProcessResource::collection($result);
    }
}
