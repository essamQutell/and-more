<?php

namespace App\Http\Requests;

use App\Models\Service;

class ExtraWorkRequest extends ApiFormRequest
{
    public function rules(): array
    {
        return [
            'project_id' => ['required', 'exists:projects,id'],
            'quotation_id' => ['required', 'exists:quotations,id'],
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
        ];
    }
}
