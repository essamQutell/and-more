<?php

namespace App\Http\Requests;

class StorePettyCashCategoryRequest extends ApiFormRequest
{
    public function rules(): array
    {
        return [
           'petty_cash_id' => ['required','exists:petty_cashes,id'],
            'supplier_id' => ['required','exists:suppliers,id'],
            'category_id' => ['required','exists:categories,id'],
            'item' => ['required','integer'],
            'attachment' => ['required','integer'],
            'invoice_number' => ['required','integer'],
            'invoice_value' => ['required','numeric'],
            'city' => ['required','string'],
            'responsible' => ['required','string'],
            'notes' => ['nullable','string'],
            'date' => ['required','date_format:Y-m-d'],
        ];
    }
}
