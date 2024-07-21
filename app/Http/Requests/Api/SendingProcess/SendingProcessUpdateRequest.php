<?php

namespace App\Http\Requests\Api\SendingProcess;

use Illuminate\Foundation\Http\FormRequest;

class SendingProcessUpdateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'user_id' => ['bail', 'nullable', 'exists:users,id'],
            'when' => ['bail', 'nullable', 'date', 'after:1 hour'],
            'message' => ['bail', 'array'],
            'message.subject' => ['bail', $this->has('message') ? 'required' : 'nullable', 'string'],
            'message.text' => ['bail', $this->has('message') ? 'required' : 'nullable', 'string'],
            'message.html' => ['bail', $this->has('message') ? 'required' : 'nullable', 'string'],
            'attach_receivers' => ['bail', 'array'],
            'attach_receivers.*' => ['bail', 'required', 'integer'],
            'detach_receivers' => ['bail', 'array'],
            'detach_receivers.*' => ['bail', 'required', 'integer'],
        ];
    }
}
