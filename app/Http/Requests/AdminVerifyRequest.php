<?php

namespace App\Http\Requests\Auth;

use App\Http\Requests\ApiFormRequest;

class AdminVerifyRequest extends ApiFormRequest
{
    public function rules(): array
    {
        return [
            'code' => ['required', 'exists:admins,code', 'digits:6'],
        ];
    }
}
