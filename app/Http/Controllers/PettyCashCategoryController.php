<?php

namespace App\Http\Controllers;

use App\Http\Requests\Settings\PageRequest;
use App\Http\Requests\StorePettyCashCategoryRequest;
use App\Http\Requests\StorePettyCashRequest;
use App\Http\Resources\PettyCashCategoryResource;
use App\Http\Resources\PettyCashResource;
use App\Models\PettyCash;
use App\Models\PettyCashCategory;
use App\Models\Project;
use App\Services\CalculateCostService;
use App\Traits\ResponseTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PettyCashCategoryController extends Controller
{
    use ResponseTrait;

    private CalculateCostService $calculateCostService;

    public function __construct(CalculateCostService $calculateCostService)
    {
        $this->calculateCostService = $calculateCostService;
    }

    public function show(PageRequest $request, Project $project): JsonResponse
    {
        $categories = $project->pettyCash->categories()->paginate($request->page_count);
        return self::successResponsePaginate(
            data: PettyCashCategoryResource::collection($categories)->response()->getData(true)
        );
    }

    public function store(StorePettyCashCategoryRequest $request): JsonResponse
    {
        $pettyData = $request->safe()->except('project_id');
        $project = Project::find($request->project_id);
        $pettyData['petty_cash_id'] = $project->pettyCash->id;

        $pettyCashCategory = PettyCashCategory::create($pettyData);
        $this->calculateCostService->calculatePettyCash($project, $pettyCashCategory);
        return self::successResponse(data: __('application.added'));
    }
}
