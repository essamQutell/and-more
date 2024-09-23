<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Http\Requests\Settings\PageRequest;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use App\Traits\ResponseTrait;

class CategoryController extends Controller
{
    use ResponseTrait;
    public function index(PageRequest $pageRequest)
    {
        $categories = Category::paginate($pageRequest->page_count);;

        return self::successResponsePaginate(data: CategoryResource::collection($categories)->response()->getData(true));
    }

    public function categories()
    {
        $categories = Category::all();
        return self::successResponse(data: CategoryResource::collection($categories));
    }

    public function store(CategoryRequest $request)
    {
        $category = Category::create($request->validated());

        return self::successResponse(__('application.added'), CategoryResource::make($category));
    }

    public function show(Category $category)
    {
        return self::successResponse(data: CategoryResource::make($category));
    }

    public function update(CategoryRequest $request, Category $category)
    {
        $category->update($request->validated());

        return self::successResponse(__('application.added'), CategoryResource::make($category));
    }

    public function destroy(Category $category)
    {
        $category->delete();

        return self::successResponse(__('application.deleted'));
    }
}
