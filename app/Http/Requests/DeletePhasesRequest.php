<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DeletePhasesRequest extends ApiFormRequest
{

    public function rules(): array
    {
        return [
            'phases' => ['array','min:1','required'],
            'phases.*' => ['exists:phases,id'],
        ];
    }
}
