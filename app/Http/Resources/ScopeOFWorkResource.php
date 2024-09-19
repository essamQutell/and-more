<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ScopeOFWorkResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */

    public function toArray(Request $request): array
    {
//        dd($this->quotation->quotationServices()->get());
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
            'created_at' => $this->created_at?  convert_date($this->created_at): '',
            'services' => ServiceQuotationResource::collection($this->quotation->quotationServices->map->service->unique('parent_id')),
        ];
    }
}
