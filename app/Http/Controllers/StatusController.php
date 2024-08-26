<?php

namespace App\Http\Controllers;

use App\Http\Requests\StatusRequest;
use App\Http\Resources\StatusResource;
use App\Models\Status;
use App\Traits\ResponseTrait;

class StatusController extends Controller
{
    use ResponseTrait;
    public function index()
    {
        $statuses = Status::paginate(10);
        return self::successResponsePaginate(StatusResource::collection($statuses)->response()->getData(true));
    }

    public function store(StatusRequest $request)
    {
        $status = Status::create($request->validated());
        return self::successResponse(__('application.added'), StatusResource::make($status));
    }

    public function show(Status $status)
    {
        return self::successResponse(data: StatusResource::make($status));
    }

    public function update(StatusRequest $request, Status $status)
    {
        $status->update($request->validated());

        return self::successResponse(__('application.updated'), StatusResource::make($status));
    }

    public function destroy(Status $status)
    {
        $status->delete();

        return self::successResponse(message: __('application.deleted'));
    }
}
