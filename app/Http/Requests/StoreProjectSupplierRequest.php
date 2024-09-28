<?php

namespace App\Http\Requests;

class StoreProjectSupplierRequest extends ApiFormRequest
{

    public function rules(): array
    {
        return [
            'project_id' => ['required','exists:projects,id'],
            'supplier_id' => ['required','exists:suppliers,id'],
            'quotation_id' => ['required','exists:quotations,id'],
            'project_team_id' => ['required','exists:project_admins,id'],
            'accrual_percentage' => ['required'],
            'paid' => ['required'],
            'remain' => ['nullable'],
            'note' => ['nullable','string'],
            'date' => ['required','date_format:Y-m-d'],
            'city' => ['required','string'],
            'category_id' => ['required','exists:categories,id'],
            'item' => ['required','string'],
            'approvals' => ['required','integer'],
            'due_percentage' => ['required','integer','max:100'],
            'total_cost' => ['required'],
            'deposit' => ['nullable'],
            'discount' =>[ 'required','numeric'],
            'actual_cost' => ['nullable','numeric'],
            'attachment_id' => ['required','integer'],
        ];
    }
}
