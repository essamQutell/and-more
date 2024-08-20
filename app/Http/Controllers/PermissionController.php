<?php

namespace App\Http\Controllers;

use App\Enums\ActionEnum;
use App\Enums\AdminSectionEnum;
use App\Http\Controllers\Controller;
use App\Http\Resources\ActionResource;
use App\Http\Resources\AdminSectionResource;
use App\Http\Resources\PermissionResource;
use App\Models\Role;
use App\Traits\ResponseTrait;
use Illuminate\Http\JsonResponse;

class PermissionController extends Controller
{
    use ResponseTrait;

    // TODO: get permissions by role
    public function getPermissionsByRole(Role $role): JsonResponse
    {
        return self::successResponse(data: PermissionResource::collection($role->permissions));
    }

    // TODO: get permissions
    public function adminSections(): JsonResponse
    {
        return self::successResponse(data: AdminSectionResource::collection(AdminSectionEnum::cases()));
    }

    // TODO: get actions
    public function actions(): JsonResponse
    {
        return self::successResponse(data: ActionResource::collection(ActionEnum::cases()));
    }
}
