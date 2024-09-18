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
                $this->supplier_team ? Rule::unique('supplier_teams','name')->ignore($this->supplier_team->id)
                    : Rule::unique('supplier_teams')
            ],
            'email' => [
                'nullable',
                'string',
                'email',
                'max:255',
                $this->supplier_team ? Rule::unique('supplier_teams','email')->ignore($this->supplier_team->id)
                    : Rule::unique('supplier_teams','email')
            ],
            'phone' => [
                'nullable',
                'string',
                'max:255',
                $this->supplier_team ? Rule::unique('supplier_teams','phone')->ignore($this->supplier_team->id)
                    : Rule::unique('supplier_teams','phone')
            ],
        ];
    }
}
