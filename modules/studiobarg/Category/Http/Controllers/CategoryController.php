<?php

namespace Studiobarg\Category\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use studiobarg\Category\Http\Requests\CategoryRequest;
use studiobarg\Category\Models\Category;
use studiobarg\Category\Repository\categoryRepo;
use studiobarg\Category\Responses\AjaxResponse;

class CategoryController extends Controller
{
    use AuthorizesRequests;
    public $repo;

    public function __construct(categoryRepo $categoryRepo)
    {
        $this->repo = $categoryRepo;
    }//End Method

    public function index()
    {
        $this->authorize('manage', category::class);
        $categories = $this->repo->all();
        return view('Category::index', compact('categories'));
    } //End Method

    public function store(CategoryRequest $request)
    {
        $this->authorize('manage', category::class);
        $this->repo->store($request);
        return back();
    }//End Method

    public function edit($categoryId)
    {
        $this->authorize('manage', category::class);
        $category = $this->repo->findById($categoryId);
        $categories = $this->repo->allExceptById($categoryId);
        return view('Category::edit', compact('category', 'categories'));
    }//End Method

    public function update($categoryId, Request $request)
    {
        $this->authorize('manage', category::class);
        $this->repo->update($categoryId, $request);
        return back();
    }//End Method

    public function destroy($categoryId)
    {
        $this->authorize('manage', category::class);
        try {
            $this->repo->delete($categoryId);
            return AjaxResponse::successResponse();
        } catch (\Exception $exception) {
           return AjaxResponse::errorResponse($exception);
        }
    }//End Method
}
