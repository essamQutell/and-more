<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProjectSupplierRequest;
use App\Models\ProjectSupplier;
use App\Traits\ResponseTrait;

class ProjectSupplierController extends Controller
{
    use ResponseTrait;

    public function store(StoreProjectSupplierRequest $request)
    {
        $projectSupplier=ProjectSupplier::create($request->validated());
        $projectSupplier->quotation->update([
            'actual_cost' =>($projectSupplier->quotation->actual_cost) + ($projectSupplier->actual_cost)
        ]);
        return self::successResponse(__('application.added'));
    }

}
