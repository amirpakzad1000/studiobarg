<?php

namespace Studiobarg\Category\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use studiobarg\Category\Http\Requests\CategoryRequest;
use studiobarg\Category\Repository\categoryRepo;
use studiobarg\Category\Responses\AjaxResponse;

class CategoryController extends Controller
{
    public $repo;

    public function __construct(categoryRepo $categoryRepo)
    {
        $this->repo = $categoryRepo;
    }//End Method

    public function index()
    {
        $categories = $this->repo->all();
        return view('Category::index', compact('categories'));
    }//End Method

    public function store(CategoryRequest $request)
    {
        $this->repo->store($request);
        return back();
    }//End Method

    public function edit($categoryId)
    {
        $category = $this->repo->findById($categoryId);
        $categories = $this->repo->allExceptById($categoryId);
        return view('Category::edit', compact('category', 'categories'));
    }//End Method

    public function update($categoryId, Request $request)
    {
        $this->repo->update($categoryId, $request);
        return back();
    }//End Method

    public function destroy($categoryId)
    {
        try {
            $this->repo->delete($categoryId);
            return AjaxResponse::successResponse();
        } catch (\Exception $exception) {
           return AjaxResponse::errorResponse($exception);
        }
    }//End Method
}
