<?php

namespace App\Http\Requests;

use App\Models\Service;
use Illuminate\Validation\Rule;

class ServiceRequest extends ApiFormRequest
{
    public function rules(): array
    {
        return [
            'name_ar' => [Rule::requiredIf($this->routeIs('services.store')), 'string', 'max:255'],
            'name_en' => [Rule::requiredIf($this->routeIs('services.store')), 'string', 'max:255'],
            'parent_id' => ['nullable', 'exists:services,id',function ($attribute, $value, $fail) {
                if ($this->routeIs('services.update')) {
                if (!is_null($value)) {
                    $service = Service::find($this->service->id);
                    if ($service && $service->services()->exists()) {
                        $fail ('A main service with sub-services cannot be assigned as a child.');
                    }
                }
            }}],
        ];
    }
}
