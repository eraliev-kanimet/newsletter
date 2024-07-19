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

    protected array $variables = ['users'];
    protected array $sorts = ['created_at', 'updated_at'];

    protected function query(): Builder
    {
        $query = SendingProcess::query();

        if ($this->hasVariable('users')) {
            $users = convertArrayToIntegers($this->variable('users'));

            $query->whereIn('user_id', $users);
        }

        return $query;
    }

    protected function resource(mixed $result): AnonymousResourceCollection
    {
        return SendingProcessResource::collection($result);
    }
}
