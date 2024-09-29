<?php

namespace App\Http\Resources;

use App\Models\ExtraWork;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin ExtraWork */
class ExtraWorkResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'service' => $this->service?->name,
            'price' => $this->price,
            'quantity' => $this->quantity,
            'days' => $this->days,
        ];
    }
}
