<?php

namespace App\Http\Resources;

use App\Models\Receiver;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ReceiverResource extends JsonResource
{
    /**
     * @var Receiver
     */
    public $resource;

    public function toArray(Request $request): array
    {
        $user = $this->resource->user;

        return [
            'id' => $this->resource->id,
            'is_active' => $this->resource->is_active,
            'user' => [
                'id' => $user->id,
                'is_active' => (bool)$user->is_active,
                'uuid' => $user->uuid,
                'email' => $user->email,
                'name' => $user->name,
            ],
            'email' => $this->resource->email,
        ];
    }
}
