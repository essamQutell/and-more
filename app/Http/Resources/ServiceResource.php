<?php

namespace App\Http\Resources;

use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin Service */
class ServiceResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'main_service' => (string)$this->service?->main_service,
            'name_ar' => $this->name_ar,
            'name_en' => $this->name_en,
            'name' => (string)$this->name,

        ];
    }
}
