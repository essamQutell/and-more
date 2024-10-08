<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SubServiceQuotationResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'qty' => $this->quotationServices->first()?->quantity,
            'days' => $this->quotationServices->first()?->days,
            'margin' => $this->quotationServices->first()?->margin,
            'sales_price' => $this->quotationServices->first()?->sales_price,
            'cost' => $this->quotationServices->first()?->cost,
        ];
    }
}
