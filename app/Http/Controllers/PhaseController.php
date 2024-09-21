<?php

namespace App\Http\Controllers;

use App\Http\Requests\PhaseRequest;
use App\Http\Resources\PhaseResource;
use App\Models\Phase;
use App\Traits\ResponseTrait;

class PhaseController extends Controller
{
    use ResponseTrait;
    public function index()
    {
        $phases = Phase::paginate(10);

        return self::successResponsePaginate(data: PhaseResource::collection($phases)->response()->getData(true));
    }

    public function mainPhases()
    {
        $phases = Phase::whereParentId(null)->get();
        return self::successResponse(data: PhaseResource::collection($phases));
    }


    public function subPhases(Phase $phase)
    {
        $phases = Phase::whereParentId($phase->id)->paginate(10);
        return self::successResponsePaginate(data: PhaseResource::collection($phases)->response()->getData(true));
    }

    public function store(PhaseRequest $request)
    {
        $phase = Phase::create($request->validated());

        return self::successResponse(__('application.added'), PhaseResource::make($phase));
    }

    public function show(Phase $phase)
    {
        return self::successResponse(data: PhaseResource::make($phase));
    }

    public function update(PhaseRequest $request, Phase $phase)
    {
        $phase->update($request->validated());

        return self::successResponse(__('application.added'), PhaseResource::make($phase));
    }

    public function destroy(Phase $phase)
    {
        $phase->delete();

        return self::successResponse(__('application.deleted'));
    }
}
