<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProjectSupplierResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'supplier' => $this->supplier?->name,
            'date' => $this->date,
            'city' => $this->city,
            'approvals' => $this->approvals?->label(),
            'due_percentage' => $this->due_percentage,
            'total_cost' => $this->total_cost,
            'deposit' => $this->deposit,
            'discount' => $this->discount,
            'actual_cost' => $this->actual_cost,
            'attachment' => $this->attachment_id?->label(),

        ];
    }
}
