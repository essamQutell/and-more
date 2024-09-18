<?php

namespace App\Http\Resources;

use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin Supplier */
class SupplierResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' =>(int) $this->id,
            'name' =>(string) $this->name,
            'email' =>(string) $this->email,
            'phone' =>(string) $this->phone,
            'address' =>(string) $this->address,
            'balance' =>(double) $this->balance,
            'created_at' => $this->created_at ? convert_date($this->created_at) : '',
        ];
    }
}
