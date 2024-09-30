<?php

namespace App\Http\Requests;

use App\Models\Service;
use Illuminate\Foundation\Http\FormRequest;

class StoreQuotationDealRequest extends ApiFormRequest
{

    public function rules(): array
    {
        return [
            'service_id' => [
                'required',
                'exists:services,id',
                function ($attribute, $value, $fail) {
                    $service = Service::find($value);
                    if ($service && is_null($service->parent_id)) {
                        $fail('The selected service must be a sub-service, not a parent.');
                    }
                },
            ],
            'project_id' => ['required','exists:projects,id'],
            'supplier_id' => ['required','exists:suppliers,id'],
            'supplier_team_id' => ['required','exists:supplier_teams,id'],
            'status_id' => ['required','exists:statuses,id'],
            'deal_status_id' => ['required','exists:statuses,id'],
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
