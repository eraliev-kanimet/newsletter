<?php

namespace App\Http\Requests\Api\Message;

use Illuminate\Foundation\Http\FormRequest;

class MessageUpdateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'user_id' => ['bail', 'nullable', 'exists:users,id'],
            'subject' => ['bail', 'nullable', 'string'],
            'data' => ['bail', 'nullable', 'array'],
            'data.text' => ['bail', 'required', 'string'],
            'data.html' => ['bail', 'required', 'string'],
        ];
    }
}
