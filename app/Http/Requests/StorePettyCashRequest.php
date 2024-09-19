<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePettyCashRequest extends ApiFormRequest
{

    public function rules(): array
    {
        return [
            'project_id' => ['required','exists:projects,id'],
            'total_cost' => ['required','numeric'],
        ];
    }
}
