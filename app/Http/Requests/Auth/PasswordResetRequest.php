<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class PasswordResetRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'password' => ['bail', 'required', 'min:8', 'confirmed'],
            'token' => ['bail', 'required'],
        ];
    }
}
