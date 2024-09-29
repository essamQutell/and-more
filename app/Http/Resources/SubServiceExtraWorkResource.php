<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SubServiceExtraWorkResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'qty' => $this->extraWorkServices->first()?->quantity,
            'days' => $this->extraWorkServices->first()?->days,
        ];
    }
}
