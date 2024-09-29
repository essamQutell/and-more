<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ServiceExtraWorkResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->quotationServices()->first()?->id,
            'name' => $this->service?->name,
            'sub_services' => SubServiceExtraWorkResource::collection(
                $this->service?->services()->whereHas('extraWorkServices')->get()
            ),
        ];
    }
}
