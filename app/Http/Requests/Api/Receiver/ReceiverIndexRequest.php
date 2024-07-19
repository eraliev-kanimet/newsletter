<?php

namespace App\Http\Requests\Api\Receiver;

use Illuminate\Foundation\Http\FormRequest;

class ReceiverIndexRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'page' => ['bail', 'nullable', 'integer', 'min:1'],
            'per_page' => ['bail', 'nullable', 'integer', 'min:1', 'max:50'],
            'users' => ['bail', 'nullable', 'array'],
            'users.*' => ['bail', 'nullable', 'integer'],
            'created_at' => ['bail', 'nullable', 'boolean',],
            'updated_at' => ['bail', 'nullable', 'boolean',],
        ];
    }
}
