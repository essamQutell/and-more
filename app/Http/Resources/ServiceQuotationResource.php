<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ServiceQuotationResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'sub_services' => SubServiceQuotationResource::collection(
                $this->services()->where('id', $this->services()->first()->quotationServices()->first()->service_id
                )->get()),
        ];
    }
}
