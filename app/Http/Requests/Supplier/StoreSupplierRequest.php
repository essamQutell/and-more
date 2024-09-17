<?php

namespace App\Http\Requests\Supplier;

use App\Http\Requests\ApiFormRequest;
use Illuminate\Validation\Rule;

class StoreSupplierRequest extends ApiFormRequest
{

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255', Rule::unique('suppliers')->whereNull('deleted_at')],
            'email' => [
                'required', 'string', 'email', 'max:155', Rule::unique('suppliers', 'email')
                    ->whereNull('deleted_at')
            ],
            'phone' => ['required', 'string', Rule::unique('suppliers', 'phone')->whereNull('deleted_at')],
            'address' => ['required', 'string', 'max:255'],
            'balance' => ['required', 'numeric'],
        ];
    }
}
