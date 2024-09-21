<?php

namespace App\Http\Controllers;

use App\Enums\StatusEnum;
use App\Http\Requests\StatusRequest;
use App\Http\Resources\SettingListResource;
use App\Http\Resources\StatusResource;
use App\Models\Status;
use App\Traits\ResponseTrait;
use Illuminate\Http\Request;

class StatusController extends Controller
{
    use ResponseTrait;

    public function getStatus()
    {
        return self::successResponse(data: SettingListResource::collection(StatusEnum::cases()));
    }
    public function index(Request $request)
    {
        $statuses = Status::whereTypeId($request->type_id)->paginate(10);
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
