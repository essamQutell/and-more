<?php

namespace App\Http\Controllers;

use App\Http\Requests\ServiceRequest;
use App\Http\Requests\Settings\PageRequest;
use App\Http\Resources\ServiceResource;
use App\Models\Service;
use App\Traits\ResponseTrait;

class ServiceController extends Controller
{
    use ResponseTrait;

    public function index(PageRequest $pageRequest)
    {
        $services = Service::paginate($pageRequest->page_count);;

        return self::successResponsePaginate(data: ServiceResource::collection($services)->response()->getData(true));
    }

    public function mainServices()
    {
        $services = Service::whereParentId(null)->get();

        return self::successResponse(data: ServiceResource::collection($services));
    }

    public function subServices(Service $service,PageRequest $pageRequest)
    {
        $services = Service::whereParentId($service->id)->paginate($pageRequest->page_count);;

        return self::successResponsePaginate(data: ServiceResource::collection($services)->response()->getData(true));
    }

    public function store(ServiceRequest $request)
    {
        $service = Service::create($request->validated());

        return self::successResponse(__('application.added'), ServiceResource::make($service));
    }

    public function show(Service $service)
    {
        return self::successResponse(data: ServiceResource::make($service));
    }

    public function update(ServiceRequest $request, Service $service)
    {
        $service->update($request->validated());

        return self::successResponse(__('application.added'), ServiceResource::make($service));
    }

    public function destroy(Service $service)
    {
        $service->delete();

        return self::successResponse(__('application.deleted'));
    }
}
