<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PettyCashResource extends JsonResource
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
            'total_cost' => (double)$this->total_cost,
            'remaining' => (double)$this->remaining,
            'expenses' => (double)$this->expenses,
            'created_at' => $this->created_at ? convert_date($this->created_at) : $this->created_at

        ];
    }
}
