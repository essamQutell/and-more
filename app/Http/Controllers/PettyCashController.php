<?php

namespace App\Http\Controllers;

use App\Enums\ApprovalsEnum;
use App\Enums\AttachmentEnum;
use App\Enums\ItemEnum;
use App\Enums\ProgressEnum;
use App\Http\Requests\StorePettyCashRequest;
use App\Http\Resources\PettyCashResource;
use App\Http\Resources\SettingListResource;
use App\Models\Project;
use App\Traits\ResponseTrait;
use Illuminate\Http\JsonResponse;

class PettyCashController extends Controller
{
    use ResponseTrait;

    public  function show(Project $project): JsonResponse
    {
        return self::successResponse(data: PettyCashResource::make($project->pettyCash));
    }

    public function update(Project $project, StorePettyCashRequest $request): JsonResponse
    {
        $project->pettyCash()->update([
            'total_cost' => $request->total_cost,
            'remaining' => $request->total_cost - $project->pettyCash->expenses,
        ]);
        return self::successResponse(message: __('application.updated'));
    }

    public function listItems()
    {
        return self::successResponse(data: SettingListResource::collection(ItemEnum::cases()));
    }

    public function listAttachments()
    {
        return self::successResponse(data: SettingListResource::collection(AttachmentEnum::cases()));
    }
    public function listApprovals()
    {
        return self::successResponse(data: SettingListResource::collection(ApprovalsEnum::cases()));
    }

    public function listProgress()
    {
        return self::successResponse(data: SettingListResource::collection(ProgressEnum::cases()));
    }
}
