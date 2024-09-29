<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProjectPhaseRequest;
use App\Http\Resources\PhaseResource;
use App\Models\Project;
use App\Models\ProjectPhase;
use App\Traits\ResponseTrait;

class ProjectPhaseController extends Controller
{
    use ResponseTrait;

//todo:  store phases in project flow

    public function projectPhases(Project $project)
    {
        return self::successResponse(data:  PhaseResource::collection($project->phases) );
    }

    public function storePhases(StoreProjectPhaseRequest $request)
    {
        $project = Project::find($request->project_id);
        $project->phases()->sync($request->phase_ids);
        return self::successResponse(message: __('application.added'));
    }

}
