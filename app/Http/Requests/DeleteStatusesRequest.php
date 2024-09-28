<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DeleteStatusesRequest extends ApiFormRequest
{
    public function rules(): array
    {
        return [
            'statuses' => ['required', 'array', 'exists:statuses,id'],
            'statuses.*' => ['exists:statuses,id'],
        ];
    }
}
