<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PettyCashCategoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => (int)$this->id,
            'supplier' => (string)$this->supplier->name,
            'category'=>(string) $this->category?->name,
            'item' => (string)$this->item?->label(),
            'attachment' => (string)$this->attachment?->label(),
            'invoice_number' => (int)$this->invoice_number,
            'invoice_value' => (double)$this->invoice_value,
            'city' => (string)$this->city,
            'responsible' => (string)$this->responsible,
            'notes' => (string)$this->notes,
            'date' => $this->date ? convert_date($this->date) : $this->date
        ];
    }
}
