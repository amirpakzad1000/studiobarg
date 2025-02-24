<?php

namespace studiobarg\Articles\Repositories;

use Illuminate\Support\Str;
use studiobarg\Articles\Models\Article;
use studiobarg\RolePermission\Models\Permission;

class ArticleRepo
{
    public function index()
    {
        return Article::query()->paginate(10);
    }

    public function store($value)
    {
        return Article::create([
            'category_id' => $value->category_id,
            'author_id' => $value->author_id,
            'title' => $value->title,
            'slug' => Str::slug($value->slug),
            'type' => $value->type,
            'status' => $value->status,
            'description' => $value->description,
            'short_desc' => $value->short_desc,

        ]);
    }

    public function findById($id)
    {
        return Article::findOrFail($id);
    }

    public function update($id, $value)
    {
        return Article::where('id',$id)->update([
            'category_id' => $value->category_id,
            'author_id' => $value->author_id,
            'title' => $value->title,
            'slug' => Str::slug($value->slug),
            'type' => $value->type,
            'status' => $value->status,
            'description' => $value->description,
            'short_desc' => $value->short_desc,
        ]);
    }

    public function updateConfirmationStatus($id, string $status)
    {
        return Article::query()->where('id', $id)->update(['confirmation_status' => $status]);
    }

}
