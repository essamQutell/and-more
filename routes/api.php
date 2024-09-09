<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\PhaseController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\ServiceController;
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
    Route::get('admins/{role}/role', [AdminController::class, 'adminsByRole']);

    Route::apiResource('roles', RoleController::class);
    Route::post('roles/{role}/update', [RoleController::class,'update']);

    Route::apiResource('projects', ProjectController::class);
    Route::post('projects/{project}/update', [ProjectController::class,'update']);

    Route::apiResource('statuses', StatusController::class);
    Route::post('statuses/{status}/update', [StatusController::class,'update']);

    Route::apiResource('services', ServiceController::class);
    Route::post('services/{service}/update', [ServiceController::class,'update']);

    Route::apiResource('categories', CategoryController::class);
    Route::post('categories/{category}/update', [CategoryController::class,'update']);

    Route::apiResource('phases', PhaseController::class);
    Route::post('phases/{phase}/update', [PhaseController::class,'update']);

    Route::apiResource('suppliers', SupplierController::class);
});
