<?php

namespace App\Http\Requests\Api\User;

use Illuminate\Foundation\Http\FormRequest;

class UserCreateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'is_active' => ['bail', 'nullable', 'boolean',],
            'email' => ['bail', 'required', 'max:255', 'email', 'unique:users',],
            'name' => ['bail', 'required', 'max:255',],
            'password' => ['bail', 'nullable', 'min:8', 'max:255',],
        ];
    }
}
