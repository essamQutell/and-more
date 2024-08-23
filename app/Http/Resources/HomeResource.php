<?php

namespace App\Http\Resources;

use App\Models\Admin;
use App\Models\Project;
use App\Models\Supplier;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class HomeResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'users' => User::count(),
            'projects' => Project::count(),
            'suppliers' => Supplier::count(),
            'admins' => Admin::count(),
        ];
    }
}
