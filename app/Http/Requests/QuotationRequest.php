<?php

namespace App\Http\Requests;

class QuotationRequest extends ApiFormRequest
{
    public function rules(): array
    {
        return [
            'services.*.id' => ['required', 'exists:services,id'],
            'services.*.price' => ['required', 'numeric'],
            'services.*.quantity' => ['required', 'numeric'],
            'services.*.days' => ['required', 'numeric'],
            'services.*.margin' => ['required', 'numeric'],
            'agency_fee' => ['nullable', 'numeric'],
            'project_id' => ['nullable', 'exists:projects,id','unique:quotations'],
        ];
    }
}
