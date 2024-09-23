<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SubServiceQuotationDealResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'qty' => $this->quotationServices->first()?->quantity,
            'days' => $this->quotationServices->first()?->days,
            'duration' => $this->quotationDeals->first()?->duration,
            'start_date' => $this->quotationDeals->first()?->start_date,
            'end_date' => $this->quotationDeals->first()?->end_date,
            'achievement' => $this->quotationDeals->first()?->achievement,
            'lead' => $this->quotationDeals->first()?->projectAdmin?->admin?->name ,
            'status' => $this->quotationDeals->first()?->status->name ,
            'consequential_effect' => $this->quotationDeals->first()?->consequential_effect,
            'supplier' => $this->quotationDeals->first()?->supplier?->name,
            'supplier_team' => $this->quotationDeals->first()?->supplierTeam?->name,
            'supplier_team_phone' => $this->quotationDeals->first()?->supplierTeam?->phone,
            'progress' => $this->quotationDeals->first()?->progress_id?->label(),
            'deal_status' => $this->quotationDeals->first()?->dealStatus?->name,
            'notes' => $this->quotationDeals->first()?->notes,


        ];
    }
}
