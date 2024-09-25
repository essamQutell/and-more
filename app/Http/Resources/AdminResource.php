<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AdminResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => (int)$this->id,
            'role_id' => (int) $this->role()?->id,
            'name' => (string)$this->name,
            'email' => (string)$this->email,
            'phone' => (string)$this->phone,
            'access_token' => (string) $this->access_token,
            'role_name' => (string) $this->role()?->name,
            'image' => (string) $this->image
        ];
    }
}
