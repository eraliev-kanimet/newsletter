<?php

namespace App\Http\Requests\Api\Receiver;

use Illuminate\Foundation\Http\FormRequest;

class ReceiverIndexRequest extends FormRequest
{
    public function rules(): array
    {
        return request_index_rules();
    }
}
