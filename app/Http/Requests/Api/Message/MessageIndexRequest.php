<?php

namespace App\Http\Requests\Api\Message;

use Illuminate\Foundation\Http\FormRequest;

class MessageIndexRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            ...request_index_rules(),
            'q' => ['bail', 'nullable', 'string'],
        ];
    }
}
