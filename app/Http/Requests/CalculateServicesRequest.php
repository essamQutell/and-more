<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CalculateServicesRequest extends ApiFormRequest
{
    public function rules(): array
    {
        return [
               'services.*.price' => ['required', 'numeric'],
               'services.*.quantity' => ['required', 'numeric'],
               'services.*.days' => ['required', 'numeric'],
               'services.*.margin' => ['required', 'numeric'],
               'agency_fee' => ['nullable', 'numeric'],
               'discount_percentage' => ['nullable', 'numeric'],
        ];
    }
}
