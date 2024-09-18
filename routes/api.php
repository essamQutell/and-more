<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\PhaseController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ProjectFlowController;
use App\Http\Controllers\QuotationController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\StatusController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\SupplierTeamController;
use Illuminate\Support\Facades\Route;


Route::post('admin/login', [AuthController::class, 'login']);
Route::controller(PermissionController::class)->group(function () {
    Route::get('admin-sections', 'adminSections');
    Route::get('actions', 'actions');
    Route::get('roles/{role}/permissions', 'getPermissionsByRole');
});
Route::get('statuses/types', [StatusController::class,'getStatus']);
Route::get('projects/types', [ProjectController::class,'getProjectTypes']);
Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('home', [HomeController::class, 'index']);
    Route::group(['prefix' => 'admin'], function () {
        Route::get('logout', [AuthController::class, 'logout']);
        Route::get('profile', [AuthController::class, 'profile']);
    });
    Route::apiResource('admins', AdminController::class);
    Route::get('admins/{role}/role', [AdminController::class, 'adminsByRole']);
    Route::post('admins/update/{admin}', [AdminController::class, 'update']);

    Route::apiResource('roles', RoleController::class);
    Route::post('roles/update/{role}', [RoleController::class,'update']);
    Route::get('all/roles/admins', [RoleController::class,'rolesWithAdmins']);

    Route::apiResource('projects', ProjectController::class);
    Route::post('projects/update/{project}', [ProjectController::class,'update']);

    Route::apiResource('statuses', StatusController::class);
    Route::post('statuses/update/{status}', [StatusController::class,'update']);

    Route::apiResource('services', ServiceController::class);
    Route::get('sub-services/{service}', [ServiceController::class,'subServices']);
    Route::post('services/update/{service}', [ServiceController::class,'update']);

    Route::apiResource('categories', CategoryController::class);
    Route::post('categories/update/{category}', [CategoryController::class,'update']);

    Route::apiResource('phases', PhaseController::class);
    Route::get('phases/{phase}', [PhaseController::class,'subPhases']);
    Route::post('phases/update/{phase}', [PhaseController::class,'update']);

    Route::post('calculate/service/cost', [QuotationController::class,'calculateServiceCost']);
    Route::post('calculate/services/cost', [QuotationController::class,'calculateServicesCost']);

    Route::post('store/quotation', [QuotationController::class,'store']);
    Route::get('quotation/{project}', [QuotationController::class,'quotationDetails']);

    Route::apiResource('suppliers', SupplierController::class);
    Route::post('suppliers/{supplier}/update', [SupplierController::class, 'update']);
    Route::apiResource('supplier-teams', SupplierTeamController::class)->parameters([ 'supplier-teams' => 'supplierTeam']);
    Route::post('supplier-teams/{supplierTeam}/update', [SupplierTeamController::class,'update']);
    Route::post('project-flow/phases/store', [ProjectFlowController::class,'storePhases']);
    Route::get('project/{project}/scope-work', [ProjectController::class,'getScopeOfWork']);


});
