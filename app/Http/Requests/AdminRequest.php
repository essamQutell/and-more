<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;

class AdminRequest extends ApiFormRequest
{
    public function rules(): array
    {
        return [
            'name' => [Rule::requiredIf($this->routeIs('admins.store')), 'string', 'max:255'],
            'email' => [Rule::requiredIf($this->routeIs('admins.store')), 'string', 'email', 'max:255', Rule::unique('admins', 'email')->ignore($this->admin)],
            'password' => [Rule::requiredIf($this->routeIs('admins.store')), 'string', 'min:8', 'confirmed'],
            'role_id' => ['required', 'exists:roles,id'],
        ];
    }


}
