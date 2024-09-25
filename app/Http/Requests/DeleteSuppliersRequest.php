<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DeleteSuppliersRequest extends ApiFormRequest
{

    public function rules(): array
    {
        return [
            'suppliers' => ['array', 'min:1', 'required'],
            'suppliers.*' => ['integer', 'exists:suppliers,id'],
        ];
    }
}
