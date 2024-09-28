<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\RoleRequest;
use App\Http\Requests\Settings\PageRequest;
use App\Http\Resources\RoleAdminResource;
use App\Http\Resources\RoleResource;
use App\Models\Role;
use App\Traits\ResponseTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    use ResponseTrait;

    public function index(PageRequest $pageRequest): JsonResponse
    {
        $roles = Role::WithoutRoleSuperAdmin()->paginate($pageRequest->page_count);;

        return self::successResponsePaginate(data: RoleResource::collection($roles)->response()->getData(true));
    }

    public function roles()
    {
        $roles = Role::WithoutRoleSuperAdmin()->get();
        return self::successResponse(data: RoleResource::collection($roles));
    }

    public function rolesWithAdmins(): JsonResponse
    {
        return self::successResponse(data: RoleAdminResource::collection(Role::WithoutRoleSuperAdmin()->get()));
    }

    public function show(Role $role): JsonResponse
    {
        return self::successResponse(data: RoleResource::make($role));
    }

    public function store(RoleRequest $request): JsonResponse
    {
        $role = Role::create($request->only('name'));
        $role->givePermissions($request->permissions);

        return self::successResponse(__('application.added'), RoleResource::make($role));
    }

    public function update(RoleRequest $request, Role $role): JsonResponse
    {
        $role->update($request->safe()->except('permissions'));
        $role->syncPermissions($request->permissions);

        return self::successResponse(__('application.updated'), RoleResource::make($role));
    }

    public function destroy(Role $role): JsonResponse
    {
        if ($role->users()->count() > 0) {
            return self::failResponse(400, message: __('application.role_has_users'));
        }

        $role->delete();

        return self::successResponse(message: __('application.deleted'));
    }
}
