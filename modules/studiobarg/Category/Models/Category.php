<?php

namespace studiobarg\Category\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;
use studiobarg\Articles\Models\Article;
use studiobarg\Course\Models\Course;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'slug',
        'parent_id',
        'image'
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($category) {
            if (empty($category->slug)) {
                $category->slug = Str::slug($category->title);
            }
        });
    }

    public function parentCategory()
    {
        return $this->belongsTo(Category::class, 'parent_id')->withDefault([
            'title' => 'بدون والد'
        ]);
    }

    public function subCategories()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    public function getParentAttribute()
    {
        return $this->parentCategory->title;
    }

    public function course()
    {
        return $this->hasMany(Course::class);
    }

    public function article()
    {
        return $this->hasMany(Article::class);
    }
}
