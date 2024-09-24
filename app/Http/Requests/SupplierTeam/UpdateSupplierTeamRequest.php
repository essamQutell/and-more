<?php

namespace App\Http\Requests\SupplierTeam;

use App\Http\Requests\ApiFormRequest;
use Illuminate\Validation\Rule;

class UpdateSupplierTeamRequest extends ApiFormRequest
{

    public function rules(): array
    {
        return [
            'supplier_id' => ['nullable', 'exists:suppliers,id'],
            'name' => [
                'nullable',
                'string',
                'max:255',
                Rule::unique('supplier_teams','name')->ignore($this->supplierTeam->id)
            ],
            'email' => [
                'nullable',
                'string',
                'email',
                'max:255',
                Rule::unique('supplier_teams','name')->ignore($this->supplierTeam->id)
            ],
            'phone' => [
                'nullable',
                'string',
                'max:255',
                Rule::unique('supplier_teams','name')->ignore($this->supplierTeam->id)
            ],
        ];
    }
}
