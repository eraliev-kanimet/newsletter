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

    protected ?string $q = null;

    protected array $words = [];
    protected ?array $users = null;

    protected ?bool $created_at = null;
    protected ?bool $updated_at = null;

    protected function query(): Builder
    {
        $query = Message::query()->with(['user']);

        if (!is_null($this->users)) {
            $query->whereIn('user_id', $this->users);
        }

        if (!empty($this->words)) {
            $query->where(function ($subQuery) {
                foreach ($this->words as $word) {
                    $subQuery->orWhere('subject', 'like', "%$word%");
                }
            });
        }

        return $query;
    }

    protected function resource(mixed $result): AnonymousResourceCollection
    {
        return MessageResource::collection($result);
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
            '(' . implode(',', $this->words) . ')',
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

        if (!is_null($this->q)) {
            $words = cleanAndUniqueWords($this->q);

            sort($words);

            $this->words = $words;
        }

        return $this;
    }
}
