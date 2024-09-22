<?php

namespace App\Http\Controllers;

use App\Http\Requests\AdminRequest;
use App\Http\Requests\Settings\PageRequest;
use App\Http\Resources\AdminResource;
use App\Models\Admin;
use App\Models\Role;
use App\Traits\ResponseTrait;
use Illuminate\Http\JsonResponse;

class AdminController extends Controller
{
    use ResponseTrait;
    public function index( PageRequest $pageRequest)
    {
        $admins = Admin::withoutSuperAdmin()->paginate($pageRequest->page_count);
        return self::successResponsePaginate(data: AdminResource::collection($admins)->response()->getData(true));
    }

    public function adminsByRole(Role $role,PageRequest $pageRequest)
    {
        $admins = Admin::whereHas('roles', function ($query) use ($role) {
            $query->whereId($role->id);
        })->paginate($pageRequest->page_count);;
        return self::successResponsePaginate(data: AdminResource::collection($admins)->response()->getData(true));
    }

    public function store(AdminRequest $request)
    {
        $adminData = $request->safe()->except('role_id', 'password');
        $adminData['password'] = bcrypt($request->password);
        $admin = Admin::create($adminData);
        $admin->syncRoles([$request->role_id]);

        return self::successResponse( __('application.added'), AdminResource::make($admin));
    }

    public function show(Admin $admin): JsonResponse
    {
        return self::successResponse(data: AdminResource::make($admin));
    }

    public function update(AdminRequest $request, Admin $admin)
    {
        $adminData = $request->safe()->except('password', 'role_id');
        if ($request->password) {
            $adminData['password'] = bcrypt($request->password);
        }
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
