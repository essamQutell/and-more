<?php

namespace App\Http\Controllers;

use App\Http\Requests\SupplierTeam\StoreSupplierTeamRequest;
use App\Http\Requests\SupplierTeam\UpdateSupplierTeamRequest;
use App\Http\Resources\SupplierTeamResource;
use App\Models\SupplierTeam;
use App\Traits\ResponseTrait;

class SupplierTeamController extends Controller
{
    use ResponseTrait;

    //todo: add list of suppliers team
    public function index()
    {
        $supplierTeams = SupplierTeam::paginate(10);
        return self::successResponsePaginate(data: SupplierTeamResource::collection( $supplierTeams)->response()->getData(true));
    }

  //todo: add supplier team
    public function store(StoreSupplierTeamRequest $request)
    {
        $supplierTeam = SupplierTeam::create($request->validated());
        return self::successResponse(data: SupplierTeamResource::make($supplierTeam));
    }

    //todo: get supplier team
    public function show(SupplierTeam $supplierTeam)
    {
        return self::successResponse(data: SupplierTeamResource::make($supplierTeam));
    }

   //todo: update supplier team
    public function update(UpdateSupplierTeamRequest $request, SupplierTeam $supplierTeam)
    {
        $supplierTeam->update($request->validated());
        return self::successResponse(message: __('admin.updated'), data: SupplierTeamResource::make($supplierTeam));
    }

 //todo: delete supplier team
    public function destroy(SupplierTeam $supplierTeam)
    {
        $supplierTeam->delete();
        return self::successResponse(message: __('application.deleted'));
    }
}
