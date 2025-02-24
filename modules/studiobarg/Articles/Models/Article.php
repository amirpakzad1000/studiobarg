<?php

namespace studiobarg\Articles\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use studiobarg\Category\Models\Category;

class Article extends Model implements HasMedia
{
    use InteractsWithMedia;

    protected $fillable = [
        'title','slug','category_id','description','short_desc','author_id'
    ];

    const TYPE_IMG = "img";
    const TYPE_VIDEO = "video";
    const STATUS_PUBLISHED = "published";
    const STATUS_DRAFT = "draft";

    static $types = [self::TYPE_IMG, self::TYPE_VIDEO];
    static $statuses = [self::STATUS_PUBLISHED, self::STATUS_DRAFT];
    public mixed $author_id;
    protected $guarded = [];

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('article')
            ->useDisk('public');
    }

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')
            ->width(80)
            ->height(80)
            ->sharpen(10) // بهبود وضوح تصویر
            ->nonQueued(); // اجرای هم‌زمان برای تست

        $this->addMediaConversion('preview')
            ->width(600)
            ->height(600)
            ->sharpen(10) // بهبود وضوح تصویر
            ->nonQueued(); // اجرای هم‌زمان برای تست
    }

    public function category(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}
