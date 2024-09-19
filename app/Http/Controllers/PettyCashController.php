<?php

namespace App\Http\Controllers;

use App\Enums\AttachmentEnum;
use App\Enums\ItemEnum;
use App\Http\Requests\StorePettyCashRequest;
use App\Http\Resources\PettyCashResource;
use App\Http\Resources\SettingListResource;
use App\Models\PettyCash;
use App\Traits\ResponseTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PettyCashController extends Controller
{
    use ResponseTrait;

    public  function show(Request $request, PettyCash $pettyCash): JsonResponse{

        return self::successResponse(data: PettyCashResource::make($pettyCash));
    }

    public function store(StorePettyCashRequest $request): JsonResponse
    {
        PettyCash::create($request->validated());
        return self::successResponse(data: __('application.added'));
    }



    public function listItems()
    {
        return self::successResponse(data: SettingListResource::collection(ItemEnum::cases()));
    }

    public function listAttachments()
    {
        return self::successResponse(data: SettingListResource::collection(AttachmentEnum::cases()));
    }
}
