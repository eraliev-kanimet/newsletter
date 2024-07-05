<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class UserGetRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'is_active' => ['nullable', 'boolean',],
            'created_at' => ['nullable', 'boolean',],
            'updated_at' => ['nullable', 'boolean',],
        ];
    }
}
