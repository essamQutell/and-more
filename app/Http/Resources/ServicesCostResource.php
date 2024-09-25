<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ServicesCostResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'total_cost' => (double)$this['total_cost'],
            'total_sales' => (double)$this['total_sales'],
            'total_cost_percentage' => (double)$this['total_cost_percentage'],
            'total_margin' => (double)$this['total_margin'],
            'total_margin_percentage' => (double)$this['total_margin_percentage'],
            'agency_fee' => (double)$this['agency_fee'],
            'total_project_sales' => (double)$this['total_project_sales'],
            'vat' => (double)$this['vat'],
            'total_project' => (double)$this['total_project'],
        ];
    }
}
