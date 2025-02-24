<?php

namespace studiobarg\Articles\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use studiobarg\Articles\Http\Requests\ArticleRequest;
use studiobarg\Articles\Models\Article;
use studiobarg\Articles\Repositories\ArticleRepo;
use studiobarg\Category\Repository\categoryRepo;
use studiobarg\RolePermission\Models\Permission;
use studiobarg\User\Repositories\UserRepo;

class ArticlesController extends Controller
{
    use AuthorizesRequests;

    /**
     * @throws AuthorizationException
     */
    public function index()
    {
        $this->authorize('index', Article::class);
        $articles = Article::all();
        return view('Article::index', compact('articles'));
    }

    /**
     * Show the form for creating a new resource.
     * @throws AuthorizationException
     */
    public function create(UserRepo $userRepo ,CategoryRepo $categoryRepo)
    {
        $this->authorize('create', Article::class);
       $categories = $categoryRepo->all();
        $authors = $userRepo->getAuthor();

        return view('Article::create', compact('categories', 'authors'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ArticleRequest $request, UserRepo $userRepo,ArticleRepo $articleRepo)
    {
        $this->authorize('create', Article::class);

        // بررسی مجوز کاربر برای مدیریت دوره‌ها
        $authorId = $request->input('authorId', auth()->id());
        if (!auth()->user()->hasPermissionTo(Permission::PERMISSION_MANAGE_POST)) {
            $authorId = auth()->id();
        }

        // ذخیره دوره
        $course = $articleRepo->store($request->merge([
            'author_id' => $authorId,
        ]));

        // افزودن تصویر بنر در صورت ارسال آن
        if ($request->hasFile('banner_id')) {
            $course->addMedia($request->file('banner_id'))
                ->toMediaCollection('article');

            // دریافت نسخه‌های مختلف تصویر
            $thumbUrl = $course->getFirstMediaUrl('images', 'thumb');
            $previewUrl = $course->getFirstMediaUrl('images', 'preview');
        }

        // هدایت به صفحه دوره‌ها با پیام موفقیت
        return redirect()->route('articles.index')->with('success', 'article created successfully!');
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        return view('Article::show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id,UserRepo $userRepo,ArticleRepo $articleRepo,CategoryRepo $categoryRepo)
    {
        $article = $articleRepo->findById($id);
        $this->authorize('edit', Article::class);
        $categories = $categoryRepo->all();
        $authors = $userRepo->getAuthor();

        return view('Article::edit', compact('article', 'categories', 'authors'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
    }
}
