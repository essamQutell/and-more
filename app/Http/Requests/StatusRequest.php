<?php

namespace App\Http\Requests;


use Illuminate\Validation\Rule;

class StatusRequest extends ApiFormRequest
{
    public function rules(): array
    {
        return [
            'name' => [Rule::requiredIf($this->routeIs('api.v1.statuses.store')), 'string', 'max:255'],
            'type_id' => [Rule::requiredIf($this->routeIs('api.v1.statuses.store')),'in:1,2,3'],
        ];
    }
}
