<?php

namespace App\Http\Requests\Api\User;

use Illuminate\Foundation\Http\FormRequest;

class UserGetRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'is_active' => ['bail', 'nullable', 'boolean',],
            'created_at' => ['bail', 'nullable', 'boolean',],
            'updated_at' => ['bail', 'nullable', 'boolean',],
        ];
    }
}
