<?php

namespace App\Http\Requests\Supplier;

use App\Http\Requests\ApiFormRequest;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateSupplierRequest extends ApiFormRequest
{

    public function rules(): array
    {
        return [
            'name' => ['nullable', 'string', 'max:255', Rule::unique('suppliers')->ignore($this->supplier->id)
                ->whereNull('deleted_at')],
            'email' => ['nullable', 'string', 'email', 'max:255', Rule::unique('suppliers')->ignore($this->supplier->id)
                ->whereNull('deleted_at')],
            'phone' => ['nullable', 'string', 'max:255', Rule::unique('suppliers')->ignore($this->supplier->id)
                ->whereNull('deleted_at')],
            'address' => ['nullable', 'string', 'max:255'],
            'balance' => ['nullable', 'numeric'],
        ];
    }
}
