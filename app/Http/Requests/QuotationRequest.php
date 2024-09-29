<?php

namespace App\Http\Requests;

use App\Models\Service;
use Illuminate\Validation\Rule;

class QuotationRequest extends ApiFormRequest
{
    public function rules(): array
    {
        return [
            'services.*.id' => ['required', 'exists:services,id',
                function ($attribute, $value, $fail) {
                    $service = Service::find($value);
                    if ($service && is_null($service->parent_id)) {
                        $fail('The selected service must sub-service not parent.');
                    }
                },],
            'services.*.price' => ['required', 'numeric'],
            'services.*.quantity' => ['required', 'numeric'],
            'services.*.days' => ['required', 'numeric'],
            'services.*.margin' => ['required', 'numeric'],
            'agency_fee' => ['nullable', 'numeric'],
            'discount_percentage' => ['nullable', 'numeric'],
            'project_id' => ['required', 'exists:projects,id','unique:quotations'],
        ];
    }
}
