<?php

namespace App\Http\Resources;

use App\Enums\DateEnum;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin Project */
class ProjectResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'type_id' => $this->type_id,
            'status_id' => $this->status_id,
            'deal_status_id' => $this->deal_status_id,
            'name' => $this->name,
            'description' => $this->description,
            'duration' => (int)$this->duration,
            'client_name' => $this->client_name,
            'location' => $this->location,
            'venue' => $this->venue,
            'type' => $this->type_id?->label(),
            'project_number' => 'AM-'.rand(1111, 9999),
            'event_dates' => ProjectDateResource::make($this->projectDates(DateEnum::event->value)),
            'setup_dates' => ProjectDateResource::make($this->projectDates(DateEnum::setUp->value)),
            'dismantle_dates' => ProjectDateResource::make($this->projectDates(DateEnum::dismantle->value)),
            'status' => $this->statusName(),
            'deal_status' => $this->dealStatusName(),
            //            'roles' => $this->admins->map(function ($admin) {
//                return $admin->roles()->first()->id ?? null; // Assuming 'id' is the role's primary key
//            }),

            'roles' => RoleAdminResource::collection($this->admins->map(function ($admin) {
                return $admin->roles()->first() ?? null; // Assuming 'id' is the role's primary key
            })),
        ];
    }
}
