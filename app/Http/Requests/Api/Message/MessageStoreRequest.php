<?php

namespace App\Http\Requests\Api\Message;

use Illuminate\Foundation\Http\FormRequest;

class MessageStoreRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'user_id' => ['bail', 'required', 'exists:users,id'],
            'subject' => ['bail', 'required', 'string'],
            'data' => ['bail', 'required', 'array'],
            'data.text' => ['bail', 'required', 'string'],
            'data.html' => ['bail', 'required', 'string'],
        ];
    }
}
