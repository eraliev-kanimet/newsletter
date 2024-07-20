<?php

namespace App\Http\Resources;

use App\Enums\SendingProcessStatus;
use App\Models\SendingProcess;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SendingProcessResource extends JsonResource
{
    /**
     * @var SendingProcess
     */
    public $resource;

    public function toArray(Request $request): array
    {
        return [
            'id' => $this->resource->id,
            'user' => resource_user($this->resource->user),
            'status' => $this->resource->status,
            'status_text' => SendingProcessStatus::from($this->resource->status)->t(),
            'when' => $this->resource->when,
            'message' => $this->resource->message,
            'created_at' => $this->resource->created_at->format('Y-m-d H:i:s'),
            'updated_at' => $this->resource->updated_at->format('Y-m-d H:i:s'),
        ];
    }
}
