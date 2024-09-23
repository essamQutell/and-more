<?php

namespace App\Http\Controllers;

use App\Http\Requests\Settings\PageRequest;
use App\Http\Requests\Supplier\StoreSupplierRequest;
use App\Http\Requests\Supplier\UpdateSupplierRequest;
use App\Http\Resources\SupplierResource;
use App\Models\Supplier;
use App\Traits\ResponseTrait;
use GuzzleHttp\Psr7\Request;
use Illuminate\Http\JsonResponse;

class SupplierController extends Controller
{
    use ResponseTrait;

    public function index(PageRequest $pageRequest): JsonResponse
    {
        $suppliers = Supplier::paginate($pageRequest->page_count);;
        return self::successResponsePaginate(data: SupplierResource::collection($suppliers)->response()->getData(true));
    }

    public function suppliers()
    {
        $suppliers = Supplier::get();
        return self::successResponse(data: SupplierResource::collection($suppliers));
    }

    public function store(StoreSupplierRequest $request)
    {
        $supplier = Supplier::create($request->validated());
        return self::successResponse(data: SupplierResource::make($supplier));
    }

    public function show(Supplier $supplier): JsonResponse
    {
        return self::successResponse(data: SupplierResource::make($supplier));
    }

    public function update(UpdateSupplierRequest $request, Supplier $supplier)
    {
        $supplier->update($request->validated());
        return self::successResponse(message: __('admin.updated'), data: SupplierResource::make($supplier));
    }

    public function destroy(Supplier $supplier)
    {
        $supplier->delete();
        return self::successResponse(message: __('application.deleted'));
    }
}
