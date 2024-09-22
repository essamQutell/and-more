<?php

namespace App\Http\Controllers;

use App\Enums\ProjectType;
use App\Http\Requests\ProjectRequest;
use App\Http\Requests\Settings\PageRequest;
use App\Http\Resources\ProjectResource;
use App\Http\Resources\ScopeOFWorkResource;
use App\Http\Resources\SettingListResource;
use App\Http\Resources\SupplierResource;
use App\Models\Project;
use App\Models\Supplier;
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

    public function getProjectTypes()
    {
        return self::successResponse(data: SettingListResource::collection(ProjectType::cases()));
    }

    public function index(PageRequest $request)
    {
        $projects = Project::whereStatusId($request->status_id)->paginate($request->page_count);
        return self::successResponsePaginate(ProjectResource::collection($projects)->response()->getData(true));
    }

    public function store(ProjectRequest $request)
    {
        $projectData = $request->safe()->except('admins', 'dates');
        $project = Project::create($projectData);

        $this->projectService->createDates($request->dates, $project->id);

        $admins = collect($request->admins)->flatten()->unique()->toArray();
        $project->admins()->attach($admins);

        return self::successResponse(__('application.added'), ProjectResource::make($project));
    }

    public function update(ProjectRequest $request, Project $project)
    {
        $projectData = $request->safe()->except('admins', 'dates');
        $project->update($projectData);

        $project->dates()->delete();
        $this->projectService->createDates($request->dates, $project->id);

        $admins = collect($request->admins)->flatten()->unique()->toArray();
        $project->admins()->sync($admins);

        return self::successResponse(__('application.updated'), ProjectResource::make($project));
    }


    //todo list scope of work
    public function getScopeOfWork(Project $project)
    {
        return self::successResponse(data: ScopeOFWorkResource::make($project));
    }
    //todo suppliersByProject
    public function suppliersByProject(Project $project, PageRequest $pageRequest)
    {
        $suppliers = $project->suppliers()?->paginate($pageRequest->page_count);
        return self::successResponsePaginate(data: SupplierResource::collection($suppliers)->response()->getData(true));
    }

//todo  projectsBySupplier
    public function projectsBySupplier(Supplier $supplier, PageRequest $pageRequest)
    {
        $projects = $supplier->projects()?->paginate($pageRequest->page_count);
        return self::successResponsePaginate(data: ProjectResource::collection($projects)->response()->getData(true));
    }
}
