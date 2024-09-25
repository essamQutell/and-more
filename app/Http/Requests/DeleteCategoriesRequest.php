<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use mysql_xdevapi\Collection;

class DeleteCategoriesRequest extends ApiFormRequest
{

    public function rules(): array
    {
        return [
            'categories' => ['array', 'min:1', 'required'],
            'categories.*' => ['exists:categories,id'],
        ];
    }
}
