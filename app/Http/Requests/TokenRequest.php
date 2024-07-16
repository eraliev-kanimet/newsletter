<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TokenRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'token' => ['required', 'string'],
        ];
    }
}
