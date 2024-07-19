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
        return [
            'id' => $this->resource->id,
            'is_active' => $this->resource->is_active,
            'user' => resource_user($this->resource->user),
            'email' => $this->resource->email,
        ];
    }
}
