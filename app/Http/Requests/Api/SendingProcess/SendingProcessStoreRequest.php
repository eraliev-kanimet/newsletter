<?php

namespace App\Http\Requests\Api\SendingProcess;

use Illuminate\Foundation\Http\FormRequest;

class SendingProcessStoreRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'user_id' => ['bail', 'required', 'exists:users,id'],
            'when' => ['bail', $this->boolean('run_now') ? 'nullable' : 'required', 'date', 'after:1 hour'],
            'run_now' => ['bail', 'nullable', 'boolean'],
            'message' => ['bail', 'required', 'array'],
            'message.subject' => ['bail', 'required', 'string'],
            'message.text' => ['bail', $this->has('message.html') ? 'nullable' : 'required', 'string'],
            'message.html' => ['bail', $this->has('message.text') ? 'nullable' : 'required', 'string'],
            'receivers' => ['bail', 'required', 'array'],
            'receivers.*' => ['bail', 'required', 'integer'],
        ];
    }
}
