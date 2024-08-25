<?php

namespace App\Http\Requests;


class ProjectRequest extends ApiFormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'max:255'],
            'user_id' => ['required', 'exists:users,id'],
            'location' => ['required', 'string', 'max:255'],
            'venue' => ['required', 'string', 'max:255'],

            'dates' => ['required', 'array'],
            'dates.*.type' => ['required', 'integer', 'max:255'],
            'dates.*.start_date' => ['required', 'date'],
            'dates.*.end_date' => ['required', 'date'],

            'status_id' => ['required', 'exists:statuses,id'],
            'deal_status_id' => ['required', 'exists:statuses,id'],

            'admins.*' => ['required', 'exists:admins,id'],
        ];
    }
}
