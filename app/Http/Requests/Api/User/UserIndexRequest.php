<?php

namespace App\Http\Requests\Api\User;

use Illuminate\Foundation\Http\FormRequest;

class UserIndexRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'page' => ['bail', 'nullable', 'integer', 'min:1'],
            'per_page' => ['bail', 'nullable', 'integer', 'min:1', 'max:50'],
            'is_active' => ['bail', 'nullable', 'boolean',],
            'created_at' => ['bail', 'nullable', 'boolean',],
            'updated_at' => ['bail', 'nullable', 'boolean',],
        ];
    }
}
