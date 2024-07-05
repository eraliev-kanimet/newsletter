<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['bail', 'required', 'max:255'],
            'email' => ['bail', 'required', 'email', 'max:255', 'unique:users'],
            'password' => ['bail', 'required', 'min:8', 'confirmed'],
        ];
    }
}
