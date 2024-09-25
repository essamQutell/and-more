<?php

namespace App\Http\Controllers;

use App\Enums\DealStatusCheckListEnum;
use App\Enums\StatusCheckListEnum;
use App\Http\Requests\StoreQuotationDealRequest;
use App\Http\Resources\QuotationDealResource;
use App\Http\Resources\SettingListResource;
use App\Models\Project;
use App\Models\QuotationDeal;
use App\Traits\ResponseTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class QuotationDealController extends Controller
{
    use ResponseTrait;

    public function storeDeal(StoreQuotationDealRequest $request)
    {
        $quotationDealData = $request->validated();
        $project = Project::find($request->project_id);
        $quotationDealData['quotation_id'] = $project->quotation?->id;

        QuotationDeal::create($quotationDealData);
        return self::successResponse(message: __('application.added'));
    }

    public function dealList(Project $project)
    {
        return self::successResponse(data: QuotationDealResource::make($project));
    }

    public function dealStatusCheckList(): JsonResponse
    {
        return self::successResponse(data: SettingListResource::collection(DealStatusCheckListEnum::cases()));
    }

    public function statusCheckList(): JsonResponse
    {
        return self::successResponse(data: SettingListResource::collection(StatusCheckListEnum::cases()));
    }
}
