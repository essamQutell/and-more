<?php

namespace App\Http\Resources;

use App\Models\Phase;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin Phase */
class PhaseResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'main_phase_id' => (int)$this->phase?->id,
            'name_ar' => $this->name_ar,
            'name_en' => $this->name_en,
            'name' => $this->name,
            'sub_phases' => PhaseResource::collection($this->whenLoaded('phases')),
        ];
    }
}
