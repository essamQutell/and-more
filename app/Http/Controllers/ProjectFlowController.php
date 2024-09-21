<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProjectFlowRequest;
use App\Models\Project;
use App\Models\ProjectFlow;
use App\Traits\ResponseTrait;

class ProjectFlowController extends Controller
{
    use ResponseTrait;

//todo:  store phases in project flow

    public function projectPhases(Project $project)
    {
        return self::successResponse(data: $project->phases);
    }

    public function storePhases(StoreProjectFlowRequest $request)
    {
        $project = Project::find($request->project_id);
        $project->phases()->sync($request->phases);
        return self::successResponse(message: __('application.added'));
    }

}
