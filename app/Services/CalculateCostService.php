<?php

namespace App\Services;

class CalculateCostService
{

    public function calculatePettyCash($project,$pettyCashCategory): void
    {
        $totalCost = $project->pettyCash->total_cost;
        $expenses = $pettyCashCategory->pettyCash->expenses + $pettyCashCategory->invoice_value;
        $pettyCashCategory->pettyCash->update([
            'expenses' => $expenses,
            'remaining' => $totalCost - $expenses,
        ]);
    }
    public function calculateSingleCost($data): array
    {
        $cost = $this->calculateCost($data['price'], $data['quantity'], $data['days']);
        $salesPrice = $this->calculateSalesPrice($data['price'], $data['margin']);
        $totalSales = $this->calculateTotalSales($data['price'], $data['margin'], $data['quantity'], $data['days']);
        $vat = $this->calculateVat($totalSales);
        $margin = $this->calculateMargin($totalSales,$cost);

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
            'total_cost_percentage' => 0,
            'total_sales' => 0,
            'total_margin' => 0,
            'total_margin_percentage' => 0,
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
            $agencyFee = $this->calculateAgencyFee($totalSales, $agencyFeeRate);
            $totalProjectSales = $this->calculateTotalProjectSales($totalSales, $agencyFee);
            $totalMargin = $this->calculateTotalMargin($totalCost, $totalSales,$agencyFee);
            $marginPercentage = $this->calculateTotalMarginPercentage($totalMargin, $totalProjectSales);
            $costPercentage = $this->calculateTotalCostPercentage($totalCost, $totalProjectSales);
            $vat = $this->calculateVat($totalProjectSales);
            $totalProject = $this->calculateTotalProject($totalProjectSales, $vat);

            $this->updateResult(
                $result,
                $totalCost,
                $costPercentage,
                $totalSales,
                $totalMargin,
                $marginPercentage,
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
        $costPercentage,
        $totalSales,
        $totalMargin,
        $marginPercentage,
        $agencyFee,
        $totalProjectSales,
        $vat,
        $totalProject
    ): void {
        $result['total_cost'] += $totalCost;
        $result['total_cost_percentage'] += $costPercentage;
        $result['total_sales'] += $totalSales;
        $result['total_margin'] += $totalMargin;
        $result['total_margin_percentage'] += $marginPercentage;
        $result['agency_fee'] += $agencyFee;
        $result['total_project_sales'] += $totalProjectSales;
        $result['vat'] += $vat;
        $result['total_project'] += $totalProject;
    }


    private function calculateCost($price, $quantity, $days): float|int
    {
        return $price * $quantity * $days;
    }

    public function calculateTotalSales($price, $marginPercentage, $quantity, $days): float|int
    {
        return $this->calculateSalesPrice($price, $marginPercentage) * $quantity * $days;
    }

    private function calculateSalesPrice($price, $marginPercentage): float|int
    {
        $margin = $price * ($marginPercentage / 100);
        return $price + $margin;
    }
    public function calculateMargin($cost,$totalSales)
    {
        return $cost - $totalSales;
    }

    private function calculateTotalMargin($totalCost, $totalSales, $agencyFeeRate = 0)
    {
        return ($totalSales - $totalCost) + $agencyFeeRate;
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

    private function calculateTotalCostPercentage($totalCost, $totalSales): float|int
    {
        return ($totalCost / $totalSales) * 100;
    }

    private function calculateTotalMarginPercentage($totalMargin, $totalSales): float|int
    {
        return ($totalMargin / $totalSales) * 100;
    }
}
