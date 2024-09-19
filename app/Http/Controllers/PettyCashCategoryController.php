<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePettyCashCategoryRequest;
use App\Http\Requests\StorePettyCashRequest;
use App\Http\Resources\PettyCashCategoryResource;
use App\Http\Resources\PettyCashResource;
use App\Models\PettyCash;
use App\Models\PettyCashCategory;
use App\Traits\ResponseTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PettyCashCategoryController extends Controller
{
    use ResponseTrait;
    public  function show(Request $request, PettyCashCategory $pettyCashCategory): JsonResponse{

        return self::successResponse(data: PettyCashCategoryResource::make($pettyCashCategory));
    }
    public function store( StorePettyCashCategoryRequest $request): JsonResponse
    {
        //check total cost > and != expenses
        $pettyCashCategory= PettyCashCategory::create($request->validated());
        $totalCost= $pettyCashCategory->pettyCash->total_cost;
        $pettyCashCategory->pettyCash->update([
            'expenses' => $pettyCashCategory->pettyCash->expenses + $pettyCashCategory->invoice_value,
            'remaining' => $totalCost - ($pettyCashCategory->pettyCash->expenses + $pettyCashCategory->invoice_value),
        ]);

        return self::successResponse(data: __('application.added'));
    }
}
