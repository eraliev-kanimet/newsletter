<?php

namespace App\Http\Resources;

use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MessageResource extends JsonResource
{
    /**
     * @var Message
     */
    public $resource;

    public function toArray(Request $request): array
    {
        $user = $this->resource->user;

        return [
            'id' => $this->resource->id,
            'user' => [
                'id' => $user->id,
                'is_active' => (bool)$user->is_active,
                'uuid' => $user->uuid,
                'email' => $user->email,
                'name' => $user->name,
            ],
            'subject' => $this->resource->subject,
            'text' => $this->resource->data['text'] ?? null,
            'html' => $this->resource->data['html'] ?? null,
            'created_at' => $this->resource->created_at->format('Y-m-d H:i:s'),
            'updated_at' => $this->resource->updated_at->format('Y-m-d H:i:s'),
        ];
    }
}
