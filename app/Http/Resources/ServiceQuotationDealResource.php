<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ServiceQuotationDealResource extends JsonResource
{

    public function toArray(Request $request): array
    {
        return [
            'id' => $this->quotationServices()->first()?->id,
            'name' => $this->service?->name,
            'sub_services' => SubServiceQuotationDealResource::collection(
                $this->service?->services()->whereHas('quotationServices')->get()
            ),
        ];
    }
}
