<?php

namespace App\Http\Controllers;

use App\Http\Requests\CalculateServiceRequest;
use App\Http\Requests\CalculateServicesRequest;
use App\Http\Requests\QuotationRequest;
use App\Http\Resources\QuotationResource;
use App\Http\Resources\ServiceCostResource;
use App\Http\Resources\ServicesCostResource;
use App\Models\Quotation;
use App\Services\ProjectService;
use App\Traits\ResponseTrait;

class QuotationController extends Controller
{
    use ResponseTrait;

    private ProjectService $projectService;

    public function __construct(ProjectService $projectService)
    {
        $this->projectService = $projectService;
    }
    public function index()
    {
        return QuotationResource::collection(Quotation::all());
    }

    public function calculateServiceCost(CalculateServiceRequest $request)
    {
        $serviceCost = $this->projectService->calculateSingleCost($request);

        return self::successResponse( data: ServiceCostResource::make($serviceCost));
    }

    public function calculateServicesCost(CalculateServicesRequest $request)
    {
        $servicesCost = $this->projectService->calculateGeneralCost($request->services, $request->agency_fee);
        return self::successResponse( data: ServicesCostResource::make($servicesCost));
    }

    public function store(QuotationRequest $request)
    {
    }

    public function show(Quotation $quotation)
    {
        return new QuotationResource($quotation);
    }

    public function update(QuotationRequest $request, Quotation $quotation)
    {
        $quotation->update($request->validated());

        return new QuotationResource($quotation);
    }

    public function destroy(Quotation $quotation)
    {
        $quotation->delete();

        return response()->json();
    }
}
