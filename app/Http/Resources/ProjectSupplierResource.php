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
            'id' =>(int) $this->id,
            'date' => $this->date?  convert_date($this->date):'',
            'category'=>(string) $this->category->name,
            'item'=>(string)$this->item,
            'city' =>(string) $this->city,
            'supplier' => (string)$this->supplier?->name,
            'approvals' => $this->approvals?->label(),
            'due_percentage' => (double)$this->due_percentage,
            'total_cost' =>(double) $this->total_cost,
            'deposit' =>(double) $this->deposit,
            'paid'=>(double)$this->paid,
            'discount' =>(double) $this->discount,
            'actual_cost' =>(double) $this->actual_cost,
            'responsible'=>(string)$this->team->admin->name,
            'attachment' => $this->attachment_id?->label(),
            'remain' =>(double) $this->remain,
            'notes'=>(string)$this->notes,
        ];
    }
}
