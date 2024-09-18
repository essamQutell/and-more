<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProjectFlowRequest extends ApiFormRequest
{

    public function rules(): array
    {
        return [
            'project_id' =>[ 'required','exists:projects,id'],
            'phase_ids' => ['array','min:1'],
            'phase_ids.*' => ['exists:phases,id'],
        ];
    }
}
