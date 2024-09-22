<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreQuotationDealRequest;
use App\Http\Resources\QuotationDealResource;
use App\Models\Project;
use App\Models\QuotationDeal;
use App\Traits\ResponseTrait;
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
        return  self::successResponse(data: __('application.added'));
    }

    public function getAllDeals(Request $request, Project $project)
    {
        return self::successResponse(data: QuotationDealResource::make($project));
    }
}
