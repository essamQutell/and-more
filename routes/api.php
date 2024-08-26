<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\StatusController;
use App\Http\Controllers\SupplierController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::post('admin/login', [AuthController::class, 'login']);
Route::controller(PermissionController::class)->group(function () {
    Route::get('admin-sections', 'adminSections');
    Route::get('actions', 'actions');
    Route::get('roles/{role}/permissions', 'getPermissionsByRole');
});

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('home', [HomeController::class, 'index']);
    Route::group(['prefix' => 'admin'], function () {
        Route::get('logout', [AuthController::class, 'logout']);
        Route::get('profile', [AuthController::class, 'profile']);
    });
    Route::apiResource('admins', AdminController::class);
    Route::post('admins/{admin}/update', [AdminController::class, 'update']);

    Route::apiResource('roles', RoleController::class);
    Route::post('roles/{role}/update', [RoleController::class,'update']);

    Route::apiResource('projects', ProjectController::class);
    Route::post('projects/{project}/update', [ProjectController::class,'update']);

    Route::apiResource('statuses', StatusController::class);
    Route::post('statuses/{status}/update', [StatusController::class,'update']);

    Route::apiResource('suppliers', SupplierController::class);
});
