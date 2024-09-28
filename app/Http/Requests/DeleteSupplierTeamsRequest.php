<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DeleteSupplierTeamsRequest extends ApiFormRequest
{
    public function rules(): array
    {
        return [
            'supplier_teams' => ['required', 'array', 'exists:supplier_teams,id'],
            'supplier_teams.*' => ['exists:supplier_teams,id'],
        ];
    }
}
