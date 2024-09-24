<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ServiceQuotationResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->quotationServices()->first()?->id,
            'name' => $this->service?->name,
            'main_service_cost' =>  $this->calculateMainServiceCost(),
            'main_service_sales' =>  $this->calculateMainServiceSales(),
            'main_service_profit' =>  $this->calculateMainServiceProfit(),
            'sub_services' => SubServiceQuotationResource::collection(
                $this->service?->services()->whereHas('quotationServices')->get()
            ),
        ];
    }
}
