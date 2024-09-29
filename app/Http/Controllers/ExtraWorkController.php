<?php

namespace App\Http\Controllers;

use App\Http\Requests\ExtraWorkRequest;
use App\Http\Resources\ExtraWorkResource;
use App\Models\ExtraWork;
use App\Models\Project;
use App\Traits\ResponseTrait;

class ExtraWorkController extends Controller
{
    use ResponseTrait;

    public function index()
    {
        return ExtraWorkResource::collection(ExtraWork::all());
    }

    public function store(ExtraWorkRequest $request)
    {
        foreach ($request->services as $service) {
            ExtraWork::create([
                'project_id' =>  $request->project_id,
                'quotation_id' => $request->quotation_id,
                'service_id' => $service['id'],
                'price' => $service['price'],
                'quantity' => $service['quantity'],
                'days' => $service['days'],
            ]);
        }

        return self::successResponse(__('application.added'));
    }

    public function get(Project $project) {

        return self::successResponse(data: ExtraWorkResource::collection($project->extrawork));
    }

}
