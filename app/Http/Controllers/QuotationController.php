<?php

namespace App\Http\Controllers;

use App\Enums\QuotationStatusEnum;
use App\Enums\StatusEnum;
use App\Http\Requests\CalculateServiceRequest;
use App\Http\Requests\CalculateServicesRequest;
use App\Http\Requests\QuotationRequest;
use App\Http\Requests\StoreImageRequest;
use App\Http\Resources\AdminResource;
use App\Http\Resources\QuotationResource;
use App\Http\Resources\ServiceCostResource;
use App\Http\Resources\ServicesCostResource;
use App\Http\Resources\SettingListResource;
use App\Models\PettyCash;
use App\Models\Project;
use App\Models\Quotation;
use App\Models\QuotationService;
use App\Services\CalculateCostService;
use App\Services\ProjectService;
use App\Traits\ResponseTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class QuotationController extends Controller
{
    use ResponseTrait;

    private CalculateCostService $calculateCostService;

    private ProjectService $projectService;

    public function __construct(CalculateCostService $calculateCostService, ProjectService $projectService)
    {
        $this->calculateCostService = $calculateCostService;
        $this->projectService = $projectService;
    }

    public function calculateServiceCost(CalculateServiceRequest $request)
    {
        $serviceCost = $this->calculateCostService->calculateSingleCost($request);

        return self::successResponse(data: ServiceCostResource::make($serviceCost));
    }

    public function calculateServicesCost(CalculateServicesRequest $request)
    {
        $servicesCost = $this->calculateCostService->calculateGeneralCost($request->services, $request->agency_fee, $request->discount_percentage);
        return self::successResponse(data: ServicesCostResource::make($servicesCost));
    }

    public function store(QuotationRequest $request)
    {
        $quotation = $this->projectService->createQuotation($request);
        $this->projectService->createQuotationServices($quotation->id, $request->services);
        PettyCash::create(['project_id' => $request->project_id]);
        return self::successResponse(__('application.added'), QuotationResource::make($quotation));
    }

    public function quotationDetails(Project $project)
    {
        $quotation = Quotation::with(['quotationServices.service.services'])->whereProjectId($project->id)->first();

        return self::successResponse(data: QuotationResource::make($quotation));
    }

    public function changeStatus(Quotation $quotation, Request $request)
    {
        $quotation->update(['status' => $request->status]);
        return self::successResponse(__('application.updated'), QuotationResource::make($quotation));
    }

//    public function update(QuotationRequest $request, Quotation $quotation)
//    {
//        $quotation->update($request->validated());
//
//        return new QuotationResource($quotation);
//    }

    public function destroy(Quotation $quotation)
    {
        $quotation->delete();

        return response()->json();
    }

    public function quotationStatusList(): JsonResponse
    {
        return self::successResponse(data: SettingListResource::collection(QuotationStatusEnum::cases()));
    }

    public function storeImage(Project $project,  StoreImageRequest $request): JsonResponse
    {
        $title = $request->get('title');
        $image = $request->file('image');
        if ($project->quotation->$title) {
            $oldImagePath = str_replace(asset('uploads/'), '', $project->quotation->$title);
            if (file_exists(public_path('uploads/' . $oldImagePath))) {
                unlink(public_path('uploads/' . $oldImagePath));
            }
        }
        $imageBase64 = base64_encode(file_get_contents($image->getRealPath()));
        $imageBase64 = 'data:' . $image->getMimeType() . ';base64,' . $imageBase64;
        $project->quotation->update([$title => $imageBase64]);
        return self::successResponse(data: __('application.added'));
    }
}
