<?php

namespace App\Http\Controllers;

use App\Http\Requests\QuotationRequest;
use App\Http\Resources\QuotationResource;
use App\Models\Quotation;

class QuotationController extends Controller
{
    public function index()
    {
        return QuotationResource::collection(Quotation::all());
    }

    public function store(QuotationRequest $request)
    {
        return new QuotationResource(Quotation::create($request->validated()));
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
