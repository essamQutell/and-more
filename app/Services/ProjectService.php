<?php

namespace App\Services;

use App\Models\ProjectDate;
use App\Models\Quotation;
use App\Models\QuotationService;

class ProjectService
{
    private CalculateCostService $calculateCostService;

    public function __construct(CalculateCostService $calculateCostService)
    {
        $this->calculateCostService = $calculateCostService;
    }

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

    public function createQuotation($request): Quotation
    {
        $servicesCost = $this->calculateCostService->calculateGeneralCost($request->services, $request->agency_fee, $request->discount_percentage);
        return Quotation::create([
            'project_id' => $request->project_id,
            'total_cost' => $servicesCost['total_cost'],
            'total_sales' => $servicesCost['total_sales'],
            'total_margin' => $servicesCost['total_margin'],
            'agency_fee' => $servicesCost['agency_fee'],
            'discount_percentage' => $servicesCost['discount_percentage'],
            'agency_fee_total' => $servicesCost['agency_fee_total'],
            'total_vat' => $servicesCost['vat'],
            'total_project' => $servicesCost['total_project'],
            'total_project_sales' => $servicesCost['total_project_sales'],
            'total_project_sales_after_discount' => $servicesCost['total_project_sales_after_discount'],
        ]);
    }

    public function createQuotationServices(int $quotationId, array $services): void
    {
        foreach ($services as $service) {
            $this->createQuotationService($quotationId, $service);

            if (!empty($service['service_name']['sub_service_name'])) {
                $this->createSubQuotationServices($service, $quotationId);
            }
        }
    }

    private function createQuotationService(int $quotationId, array $service, ?int $parentId = null): int
    {
        $serviceCost = $this->calculateCostService->calculateSingleCost($service);

        $quotationService = QuotationService::create([
            'quotation_id' => $quotationId,
            'parent_id' => $parentId,
            'service_id' => $service['id'],
            'service_name' => $service['service_name'],
            'price' => $service['price'],
            'margin' => $service['margin'],
            'quantity' => $service['quantity'],
            'days' => $service['days'],
            'cost' => $serviceCost['cost'],
            'sales_price' => $serviceCost['sales_price'],
        ]);

        return $quotationService->id;
    }

    private function createSubQuotationServices(array $service, int $quotationId): void
    {
        $parentId = $this->createQuotationService($quotationId, $service);

        foreach ($service['service_name']['sub_service_name'] as $subService) {
            $this->createQuotationService($quotationId, $subService, $parentId);
        }
    }


}
