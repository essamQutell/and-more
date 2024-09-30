<?php

namespace App\Http\Resources;

use App\Enums\DateEnum;
use App\Models\Quotation;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin Quotation */
class QuotationResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'project_name' => $this->project?->name,
            'client_name' => $this->project?->client_name,
            'location' => $this->project?->location,
            'type' => $this->project?->type_id?->label(),
            'status' => $this->status?->label(),
            'project_date' => $this->project?->dates()->whereType(DateEnum::event->value)->first()?->start_date,
            'services' => ServiceQuotationResource::collection($this->quotationServices->map->service->unique('parent_id')),
            'total_cost'=> $this->total_cost,
            'total_sales'=> $this->total_sales,
            'total_margin'=> $this->total_margin,
            'agency_fee'=> (double)$this->agency_fee,
            'discount_percentage'=> (double)$this->discount_percentage,
            'agency_fee_total'=> $this->agency_fee_total,
            'total_project_sales'=> $this->total_project_sales,
            'total_project_sales_after_discount'=> $this->total_project_sales_after_discount,
            'vat'=> $this->total_vat,
            'total_project'=> $this->total_project,
            'actual_cost'=>(double) $this->actual_cost,
            'actual_margin'=>(double) $this->actual_margin,
            'cash_flow' => (double)$this->cash_flow,
            'cash_flow_percentage' => (double)$this->cash_flow_percentage,
            'variance' =>(double) $this->variance,
            'profit' =>(double) $this->profit
        ];
    }
}
