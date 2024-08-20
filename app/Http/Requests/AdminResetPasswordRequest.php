<?php

namespace App\Http\Requests\Auth;

use App\Http\Requests\ApiFormRequest;

class AdminResetPasswordRequest extends ApiFormRequest
{
    public function rules(): array
    {
        return [
            'email' => ['required', 'exists:admins,email'],
            'password' => ['required', 'confirmed', 'min:8', 'regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$/'],
        ];
    }
}
