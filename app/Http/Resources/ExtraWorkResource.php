<?php

namespace App\Http\Resources;

use App\Models\ExtraWork;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin Project */
class ExtraWorkResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'project_name' => $this->name,
            'project_description' => $this->description,
            'client_name' => $this->client_name,
            'status' =>(string) $this->statusName(),
            'deal_status' => $this->dealStatusName(),
            'location' =>(string) $this->location,
            'duration' =>(int) $this->duration,
            'venue' =>(string) $this->venue,
            'quotation_services' => ServiceQuotationResource::collection($this->quotation->quotationServices->map->service->unique('parent_id')),
            'extra_work_services' => ServiceExtraWorkResource::collection($this->extraWorkServices->map->service->unique('parent_id')),
        ];
    }
}
