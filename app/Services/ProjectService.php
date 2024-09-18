<?php

namespace App\Services;

use App\Models\ProjectDate;

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

    public function calculateSingleCost($data): array
    {
        $cost = $this->calculateCost($data->price, $data->quantity, $data->days);
        $salesPrice = $this->calculateSalesPrice($data->price, $data->margin);
        $totalSales = $this->calculateTotalSales($data->price, $data->margin, $data->quantity, $data->days);
        $vat = $this->calculateVat($totalSales);
        $margin = $this->calculateTotalMargin($cost,$totalSales);

        return [
            'cost' => $cost,
            'margin' => $margin,
            'sales_price' => $salesPrice,
            'total_sales' => $totalSales,
            'vat' => $vat
        ];
    }

    public function calculateGeneralCost($services, $agency_fee): array
    {
        $result = [
            'total_cost' => 0,
            'total_sales' => 0,
            'total_margin' => 0,
            'vat' => 0,
            'agency_fee' => 0,
            'total_project_sales' => 0,
            'total_project' => 0
        ];

        $vatRate = 0.15;
        $agencyFeeRate = $agency_fee / 100;

        foreach ($services as $service) {
            $totalCost = $this->calculateCost($service['price'], $service['quantity'], $service['days']);
            $totalSales = $this->calculateTotalSales(
                $service['price'],
                $service['margin'],
                $service['quantity'],
                $service['days']
            );
            $totalMargin = $this->calculateTotalMargin($totalCost, $totalSales);
            $agencyFee = $this->calculateAgencyFee($totalSales, $agencyFeeRate);
            $totalProjectSales = $this->calculateTotalProjectSales($totalSales, $agencyFee);
            $vat = $this->calculateVat($totalProjectSales);
            $totalProject = $this->calculateTotalProject($totalProjectSales, $vat);

            $this->updateResult(
                $result,
                $totalCost,
                $totalSales,
                $totalMargin,
                $agencyFee,
                $totalProjectSales,
                $vat,
                $totalProject
            );
        }

        return $result;
    }

    private function updateResult(
        &$result,
        $totalCost,
        $totalSales,
        $totalMargin,
        $agencyFee,
        $totalProjectSales,
        $vat,
        $totalProject
    ): void {
        $result['total_cost'] += $totalCost;
        $result['total_sales'] += $totalSales;
        $result['total_margin'] += $totalMargin;
        $result['agency_fee'] += $agencyFee;
        $result['total_project_sales'] += $totalProjectSales;
        $result['vat'] += $vat;
        $result['total_project'] += $totalProject;
    }


    private function calculateCost($price, $quantity, $days): float|int
    {
        return $price * $quantity * $days;
    }

    private function calculateTotalSales($price, $marginPercentage, $quantity, $days): float|int
    {
        return $this->calculateSalesPrice($price, $marginPercentage) * $quantity * $days;
    }

    private function calculateSalesPrice($price, $marginPercentage): float|int
    {
        $margin = $price * ($marginPercentage / 100);
        return $price + $margin;
    }

    private function calculateTotalMargin($totalCost, $totalSales)
    {
        return $totalSales - $totalCost;
    }

    private function calculateAgencyFee($totalSales, $agencyFeeRate): float|int
    {
        return $totalSales * $agencyFeeRate;
    }

    private function calculateTotalProjectSales($totalSales, $agencyFee)
    {
        return $totalSales + $agencyFee;
    }

    private function calculateVat($totalProjectSales): float|int
    {
        $vatRate = 0.15;
        return $totalProjectSales * $vatRate;
    }

    private function calculateTotalProject($totalProjectSales, $vat)
    {
        return $totalProjectSales + $vat;
    }
}
