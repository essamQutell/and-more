<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SupplierTeamResource extends JsonResource
{

    public function toArray(Request $request): array
    {
        return [
            'id' =>(int) $this->id,
            'name' =>(string) $this->name,
            'email' =>(string) $this->email,
            'phone' =>(string) $this->phone,
            'created_at' => $this->created_at ? convert_date($this->created_at) : '',
            'supplier' => SupplierResource::make($this->supplier),
        ];
    }
}
