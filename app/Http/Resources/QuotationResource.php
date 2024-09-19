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
            'project_name' => $this->project->name,
            'client_name' => $this->project->client_name,
            'location' => $this->project->location,
            'project_date' => $this->project->dates()->whereType(DateEnum::event->value)->first()->start_date,
            'services' => ServiceQuotationResource::make($this->quotationServices->first()->service->service),
        ];
    }
}
