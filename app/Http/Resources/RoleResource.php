<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RoleResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => (int) $this->id,
            'name' => (string) $this->name,
            'permissions' => PermissionResource::collection($this->permissions()->get()),
            'created_at' => (string) $this->created_at->format('Y-m-d'),
        ];
    }
}
