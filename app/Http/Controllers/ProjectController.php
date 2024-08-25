<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProjectRequest;
use App\Http\Resources\ProjectResource;
use App\Models\Project;
use App\Models\ProjectDate;
use App\Services\ProjectService;
use App\Traits\ResponseTrait;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    use ResponseTrait;

    private ProjectService $projectService;

    public function __construct(ProjectService $projectService)
    {
        $this->projectService = $projectService;
    }

    public function index()
    {
        return self::successResponse(__('application.success'), ProjectResource::collection(Project::all()));
    }

    public function store(ProjectRequest $request)
    {
        $projectData = $request->safe()->except('admins', 'dates');
        $project = Project::create($projectData);

        $this->projectService->createDates($request->dates, $project->id);
        $project->admins()->attach($request->admins);

        return self::successResponse(__('application.added'), ProjectResource::make($project));
    }

    public function update(ProjectRequest $request, Project $project)
    {
        $projectData = $request->safe()->except('admins', 'dates');
        $project->update($projectData);

        $project->dates()->delete();
        $this->projectService->createDates($request->dates, $project->id);

        $project->admins()->sync($request->admins);

        return self::successResponse(__('application.updated'), ProjectResource::make($project));
    }
}
