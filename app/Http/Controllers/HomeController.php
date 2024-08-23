<?php

namespace App\Http\Controllers;

use App\Http\Resources\HomeResource;
use App\Traits\ResponseTrait;

class HomeController extends Controller
{
    use ResponseTrait;
    public function index()
    {
        return self::successResponse(data: HomeResource::make([]));
    }
}
