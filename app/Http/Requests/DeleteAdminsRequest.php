<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DeleteAdminsRequest extends ApiFormRequest
{

    public function rules(): array
    {
        return [
            'admins' => ['array','min:1','required'],
            'admins.*' => ['exists:admins,id'],
        ];
    }
}
