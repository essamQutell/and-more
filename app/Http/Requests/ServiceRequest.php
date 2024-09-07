<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;

class ServiceRequest extends ApiFormRequest
{
    public function rules(): array
    {
        return [
            'name_ar' => [Rule::requiredIf($this->routeIs('services.store')), 'string', 'max:255'],
            'name_en' => [Rule::requiredIf($this->routeIs('services.store')), 'string', 'max:255'],
            'parent_id' => ['nullable', 'exists:services,id'],
        ];
    }
}
