<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Unique;

class UserUpdateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'is_active' => ['bail', 'required', 'boolean',],
            'email' => ['bail', 'nullable', 'max:255', 'email', $this->ruleEmailUnique(),],
            'name' => ['bail', 'nullable', 'max:255',],
            'password' => ['bail', 'nullable', 'min:8', 'max:255',],
        ];
    }

    protected function ruleEmailUnique(): Unique
    {
        return Rule::unique('users', 'email')->ignore($this->route('user'));
    }
}
