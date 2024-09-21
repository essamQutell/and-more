<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CalculateServiceRequest extends ApiFormRequest
{
    public function rules(): array
    {
        return [
            'price' => ['required', 'numeric'],
            'quantity' => ['required', 'numeric'],
            'days' => ['required', 'numeric'],
            'margin' => ['nullable', 'numeric'],
        ];
    }
}
