<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreQuotationDealRequest extends ApiFormRequest
{

    public function rules(): array
    {
        return [
            'project_id' => ['required','exists:projects,id'],
            'supplier_id' => ['required','exists:suppliers,id'],
            'supplier_team_id' => ['required','exists:supplier_teams,id'],
            'status_id' => ['required','exists:statuses,id'],
            'deal_status_id' => ['required','exists:statuses,id'],
            'quotation_service_id' => ['required','exists:quotation_services,id'],
            'project_admin_id' => ['required','exists:project_admins,id'],

            'start_date' => ['required','date_format:Y-m-d'],
            'end_date' => ['required','date_format:Y-m-d'],
            'duration' => ['required','integer'],
            'achievement' => ['required','integer'],
            'consequential_effect' => ['required','string'],
            'notes' => ['nullable','string'],
            'progress_id' => ['required','integer'],
        ];
    }
}
