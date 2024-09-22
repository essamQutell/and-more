<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePettyCashRequest extends ApiFormRequest
{
    public function rules(): array
    {
        return [
            'total_cost' => ['required','numeric'],
        ];
    }
}
