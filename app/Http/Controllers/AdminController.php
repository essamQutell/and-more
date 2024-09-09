<?php

namespace App\Http\Controllers;

use App\Http\Requests\AdminRequest;
use App\Http\Resources\AdminResource;
use App\Models\Admin;
use App\Models\Role;
use App\Traits\ResponseTrait;
use Illuminate\Http\JsonResponse;

class AdminController extends Controller
{
    use ResponseTrait;
    public function index()
    {
        $admins = Admin::withoutSuperAdmin()->paginate(10);
        return self::successResponsePaginate(data: AdminResource::collection($admins)->response()->getData(true));
    }

    public function adminsByRole(Role $role)
    {
        $admins = Admin::whereHas('roles', function ($query) use ($role) {
            $query->whereId($role->id);
        })->paginate(10);
        return self::successResponsePaginate(data: AdminResource::collection($admins)->response()->getData(true));
    }

    public function store(AdminRequest $request)
    {
        $adminData = $request->safe()->except('role_id', 'password');
        $admin = Admin::create($adminData);
        $admin->syncRoles([$request->role_id]);

        return self::successResponse(message: __('application.added'), data: AdminResource::make($admin));
    }

    public function show(Admin $admin): JsonResponse
    {
        return self::successResponse(data: AdminResource::make($admin));
    }

    public function update(AdminRequest $request, Admin $admin)
    {
        $adminData = $request->safe()->except('password', 'role_id');
        $admin->update($adminData);
        $admin->syncRoles($request->role_id ? [$request->role_id] : []);

        return self::successResponse(message: __('admin.updated'), data: AdminResource::make($admin));
    }

    public function destroy(Admin $admin)
    {
        $admin->delete();
        return self::successResponse(message: __('admin.deleted'));
    }
}
