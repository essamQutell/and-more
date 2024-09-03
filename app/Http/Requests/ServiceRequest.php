<?php

namespace App\Http\Requests;

class ServiceRequest extends ApiFormRequest
{
    public function rules(): array
    {
        return [
            'name_ar' => ['required', 'string', 'max:255'],
            'name_en' => ['required', 'string', 'max:255'],
            'parent_id' => ['nullable', 'exists:services,id'],
        ];
    }
}
