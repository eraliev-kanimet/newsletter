<?php

namespace App\Http\Requests\Api\Receiver;

use Illuminate\Foundation\Http\FormRequest;

class ReceiverStoreRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'is_active' => ['bail', 'nullable', 'boolean'],
            'user_id' => ['bail', 'required', 'integer', 'exists:users,id'],
            'email' => ['bail', 'required', 'email',],
        ];
    }
}
