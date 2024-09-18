<?php

namespace App\Services;

use App\Http\Requests\QuotationRequest;
use App\Models\ProjectDate;
use App\Models\Quotation;
use App\Models\QuotationService;

class ProjectService
{
    public function createDates(array $dates, int $projectId): void
    {
        foreach ($dates as $date) {
            ProjectDate::create([
                'project_id' => $projectId,
                'type' => $date['type'],
                'start_date' => $date['start_date'],
                'end_date' => $date['end_date'],
            ]);
        }
    }

    public function createQuotation(QuotationRequest $request, array $servicesCost): Quotation
    {
        return Quotation::create([
            'project_id' => $request->project_id,
            'total_cost' => $servicesCost['total_cost'],
            'total_sales' => $servicesCost['total_sales'],
            'total_margin' => $servicesCost['total_margin'],
            'agency_fee' => $servicesCost['agency_fee'],
            'total_vat' => $servicesCost['vat'],
            'total_project' => $servicesCost['total_project'],
            'total_project_sales' => $servicesCost['total_project_sales'],
        ]);
    }

    public function createQuotationServices(int $quotationId, array $services, array $serviceCost): void
    {
        foreach ($services as $service) {
            QuotationService::create([
                'quotation_id' => $quotationId,
                'service_id' => $service['id'],
                'price' => $service['price'],
                'margin' => $service['margin'],
                'quantity' => $service['quantity'],
                'days' => $service['days'],
                'cost' => $serviceCost['cost'],
                'sales_price' => $serviceCost['sales_price'],
            ]);
        }
    }

}
