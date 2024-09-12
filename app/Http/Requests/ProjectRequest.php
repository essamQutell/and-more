<?php

namespace App\Http\Requests;


class ProjectRequest extends ApiFormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'max:255'],
            'client_name' => ['required', 'string', 'max:255'],
            'location' => ['required', 'string', 'max:255'],
            'venue' => ['required', 'string', 'max:255'],
            'type_id' => ['required', 'integer', 'max:255'],

            'dates' => ['required', 'array'],
            'dates.*.type' => ['integer', 'max:255'],
            'dates.*.start_date' => ['date','date_format:Y-m-d'],
            'dates.*.end_date' => ['date','date_format:Y-m-d'],

            'status_id' => ['required', 'exists:statuses,id'],
            'deal_status_id' => ['required', 'exists:statuses,id'],

            'admins.*' => ['required', 'exists:admins,id'],
        ];
    }
}
