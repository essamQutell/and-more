<?php

namespace App\Http\Requests\Supplier;

use App\Http\Requests\ApiFormRequest;
use Illuminate\Validation\Rule;

class StoreSupplierRequest extends ApiFormRequest
{

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255', Rule::unique('suppliers')],
            'email' => ['required', 'string', 'email', 'max:155', Rule::unique('suppliers', 'email')],
            'phone' => ['required', 'string', Rule::unique('suppliers', 'phone')],
            'address' => ['required', 'string', 'max:255'],
            'balance' => ['required', 'numeric'],
        ];
    }
}
