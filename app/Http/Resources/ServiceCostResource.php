<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ServiceCostResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'cost' => (double)$this['cost'],
            'margin' => (double)$this['margin'],
            'sales_price' => (double)$this['sales_price'],
            'total_sales' => (double)$this['total_sales'],
            'vat' => (double)$this['vat']
        ];
    }
}
