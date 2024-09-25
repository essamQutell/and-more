<?php

namespace App\Http\Requests;

class DeleteServicesRequest extends ApiFormRequest
{

    public function rules(): array
    {
        return [
            'services' => ['array', 'min:1', 'required'],
            'services.*' => ['exists:services,id'],
        ];
    }
}
