<?php

namespace App\Http\Resources;

use App\Models\QuotationDeal;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin QuotationDeal */
class QuotationDealResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'project_name' => $this->name,
            'services' => ServiceQuotationDealResource::collection($this->quotation->quotationServices->map->service->unique('parent_id')),
        ];
    }
}
