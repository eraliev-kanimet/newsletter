<?php

namespace App\Services\Models\Api\Message;

use App\Contracts\Message\ApiGetMessageServiceInterface;
use App\Http\Resources\MessageResource;
use App\Models\Message;
use App\Services\Abstract\PaginateModelWithCacheService;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class GetMessageService extends PaginateModelWithCacheService implements ApiGetMessageServiceInterface
{
    protected string $tag = 'api_messages';

    protected array $variables = ['q', 'users'];
    protected array $sorts = ['created_at', 'updated_at'];

    protected function query(): Builder
    {
        $query = Message::query()->with(['user']);

        if ($this->hasVariable('users')) {
            $users = convertArrayToIntegers($this->variable('users'));

            $query->whereIn('user_id', $users);
        }

        if ($this->hasVariable('q')) {
            $words = cleanAndUniqueWords($this->variable('q'));

            if (!empty($words)) {
                $query->where(function ($subQuery) use ($words) {
                    foreach ($words as $word) {
                        $subQuery->orWhere('subject', 'like', "%$word%");
                    }
                });
            }
        }

        return $query;
    }

    protected function resource(mixed $result): AnonymousResourceCollection
    {
        return MessageResource::collection($result);
    }
}
