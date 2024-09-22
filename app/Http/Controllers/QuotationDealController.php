<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreQuotationDealRequest;
use App\Models\QuotationDeal;
use App\Traits\ResponseTrait;
use Illuminate\Http\Request;

class QuotationDealController extends Controller
{
use ResponseTrait;
    public function storeDeal(StoreQuotationDealRequest $request)
    {
        QuotationDeal::create($request->validated());
        return  self::successResponse(data: __('application.added'));
    }
}
