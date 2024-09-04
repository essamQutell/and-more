<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PhaseRequest extends FormRequest
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
