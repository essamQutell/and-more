<?php

namespace App\Http\Requests;

class StoreImageRequest extends ApiFormRequest
{

    public function rules(): array
    {
        return [
            'title' => [
                'required',
                'string',
                'in:scope_work_signature,scope_work_stamp,delivery_note_signature,delivery_note_stamp'
            ],
            'image' => ['required', 'file', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
        ];
    }
}
