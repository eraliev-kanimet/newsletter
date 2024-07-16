<?php

namespace App\Http\Requests\Api\Receiver;

use Illuminate\Foundation\Http\FormRequest;

class ReceiverUpdateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'is_active' => ['bail', 'nullable', 'boolean'],
            'user_id' => ['bail', 'nullable', 'integer', 'exists:users,id'],
            'email' => ['bail', 'nullable', 'email',],
        ];
    }
}
