<?php

namespace App\Http\Requests\SupplierTeam;

use App\Http\Requests\ApiFormRequest;
use Illuminate\Validation\Rule;

class StoreSupplierTeamRequest extends ApiFormRequest
{


    public function rules(): array
    {
        return [
            'supplier_id' =>['required', 'exists:suppliers,id'],
            'name' => ['required', 'string', 'max:255', Rule::unique('supplier_teams')],
            'email' => [
                'required', 'string', 'email', 'max:155', Rule::unique('supplier_teams', 'email')

            ],
            'phone' => ['required', 'string', Rule::unique('supplier_teams', 'phone')],
        ];
    }
}
