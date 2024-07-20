<?php

namespace App\Http\Requests\Api\SendingProcess;

use Illuminate\Foundation\Http\FormRequest;

class SendingProcessIndexRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            ...request_index_rules(),
            'status' => ['bail', 'nullable', 'array',],
            'status.*' => ['bail', 'nullable', 'integer'],
        ];
    }
}
