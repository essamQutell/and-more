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

    public function calculateGeneralCost($services, $agency_fee, $discount_percentage = 0): array
    {
        $result = [
            'total_cost' => 0,
            'total_cost_percentage' => 0,
            'total_sales' => 0,
            'total_margin' => 0,
            'total_margin_percentage' => 0,
            'vat' => 0,
            'agency_fee_total' => 0,
            'agency_fee' => 0,
            'discount_percentage' => 0,
            'total_project_sales' => 0,
            'total_project_sales_after_discount' => 0,
            'total_project' => 0
        ];
        $agencyFeeRate = $agency_fee / 100;

        foreach ($services as $service) {
            $totalCost = $this->calculateCost($service['price'], $service['quantity'], $service['days']);
            $totalSales = $this->calculateTotalSales(
                $service['price'],
                $service['margin'],
                $service['quantity'],
                $service['days']
            );
            $agencyFeeTotal = $this->calculateAgencyFee($totalSales, $agencyFeeRate);
            $totalMargin = $this->calculateTotalMargin($totalCost, $totalSales,$agencyFeeTotal);

            $totalProjectSales = $this->calculateTotalProjectSales($totalSales, $agencyFeeTotal);

            $marginPercentage = $this->calculateTotalMarginPercentage($totalMargin, $totalProjectSales);
            $costPercentage = $this->calculateTotalCostPercentage($totalCost, $totalProjectSales);

            $totalProjectSalesAfterDiscount = $this->calculateProjectSalesAfterDiscount($totalProjectSales, $discount_percentage);

            $vat = $this->calculateVat($totalProjectSalesAfterDiscount);
            $totalProject = $this->calculateTotalProject($totalProjectSalesAfterDiscount, $vat);

            $this->updateResult(
                $result,
                $totalCost,
                $costPercentage,
                $totalSales,
                $totalMargin,
                $marginPercentage,
                $agencyFeeTotal,
                $discount_percentage,
                $agency_fee,
                $totalProjectSales,
                $totalProjectSalesAfterDiscount,
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
        $agencyFeeTotal,
        $discount_percentage,
        $agency_fee,
        $totalProjectSales,
        $totalProjectSalesAfterDiscount,
        $vat,
        $totalProject
    ): void {
        $result['total_cost'] += $totalCost;
        $result['total_cost_percentage'] += $costPercentage;
        $result['total_sales'] += $totalSales;
        $result['total_margin'] += $totalMargin;
        $result['total_margin_percentage'] += $marginPercentage;
        $result['agency_fee_total'] += $agencyFeeTotal;
        $result['discount_percentage'] = $discount_percentage;
        $result['agency_fee'] = $agency_fee;
        $result['total_project_sales'] += $totalProjectSales;
        $result['total_project_sales_after_discount'] += $totalProjectSalesAfterDiscount;
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

    private function calculateProjectSalesAfterDiscount($totalProjectSales, $discountPercentage): float|int
    {
        return $totalProjectSales - $discountPercentage;
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
