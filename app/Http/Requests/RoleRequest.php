<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RoleRequest extends ApiFormRequest
{
    public function rules(): array
    {
        return [
            'name' => [Rule::requiredIf($this->routeIs('roles.store')), 'string'],
            'permissions' => [Rule::requiredIf($this->routeIs('roles.store')), 'array', 'min:1'],
            'permissions.*' => ['exists:permissions,name', 'regex:/^[a-zA-Z0-9_-]+-[a-zA-Z0-9_-]+$/'],
        ];
    }
}
