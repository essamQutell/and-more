<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProjectFlowRequest;
use App\Http\Resources\ProjectFlowResource;
use App\Models\ProjectFlow;
use App\Traits\ResponseTrait;

class ProjectFlowController extends Controller
{
    use ResponseTrait;

    public function storePhases(StoreProjectFlowRequest $request)
    {
        $validateData = $request->validated();
        foreach ($validateData['phase_ids'] as $phase) {
            ProjectFlow::create([
                'project_id' => $validateData['project_id'],
                'phase_id' => $phase
            ]);
        }
        return self::successResponse(message: __('application.added'));
    }

}
