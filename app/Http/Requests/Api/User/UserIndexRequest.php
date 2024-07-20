<?php

namespace App\Http\Requests\Api\User;

use Illuminate\Foundation\Http\FormRequest;

class UserIndexRequest extends FormRequest
{
    public function rules(): array
    {
        $rules = request_index_rules();

        unset($rules['users']);
        unset($rules['users.*']);

        return [
            ...$rules,
            'is_active' => ['bail', 'nullable', 'boolean',],
        ];
    }
}
