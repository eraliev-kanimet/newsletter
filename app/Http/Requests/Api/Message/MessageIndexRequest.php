<?php

namespace App\Http\Requests\Api\Message;

use Illuminate\Foundation\Http\FormRequest;

class MessageIndexRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'page' => ['bail', 'nullable', 'integer', 'min:1'],
            'per_page' => ['bail', 'nullable', 'integer', 'min:1', 'max:50'],
            'q' => ['bail', 'nullable', 'string'],
            'users' => ['bail', 'nullable', 'array'],
            'users.*' => ['bail', 'nullable', 'integer'],
            'created_at' => ['bail', 'nullable', 'boolean',],
            'updated_at' => ['bail', 'nullable', 'boolean',],
        ];
    }
}
