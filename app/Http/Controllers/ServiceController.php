<?php

namespace App\Http\Controllers;

use App\Http\Requests\ServiceRequest;
use App\Http\Resources\ServiceResource;
use App\Models\Service;

class ServiceController extends Controller
{
    public function index()
    {
        return ServiceResource::collection(Service::all());
    }

    public function store(ServiceRequest $request)
    {
        return new ServiceResource(Service::create($request->validated()));
    }

    public function show(Service $service)
    {
        return new ServiceResource($service);
    }

    public function update(ServiceRequest $request, Service $service)
    {
        $service->update($request->validated());

        return new ServiceResource($service);
    }

    public function destroy(Service $service)
    {
        $service->delete();

        return response()->json();
    }
}
