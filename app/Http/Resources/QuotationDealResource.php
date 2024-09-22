<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin \App\Models\QuotationDeal */
class QuotationDealResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'project_id' => $this->id,
            'project_name' => $this->name,
        ];
    }
}
