<?php

namespace studiobarg\Course\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use studiobarg\Category\Models\Category;


class Course extends Model implements HasMedia
{
    use InteractsWithMedia;

    const TAPE_FREE = "free";
    const TAPE_CASH = "cash";
    const STATUS_COMPLETED = "completed";
    const STATUS_NOT_COMPLETED = "not-completed";
    const STATUS_LOCKED = "locked";
    const CONFIRMATION_STATUS_ACCEPTED = "accepted";
    const CONFIRMATION_STATUS_PENDING = "pending";
    const CONFIRMATION_STATUS_REJECTED = "rejected";
    static $types = [self::TAPE_FREE, self::TAPE_CASH];
    static $statuses = [self::STATUS_COMPLETED, self::STATUS_NOT_COMPLETED, self::STATUS_LOCKED];
    static mixed $confirmationStatuses = [self::CONFIRMATION_STATUS_ACCEPTED,
        self::CONFIRMATION_STATUS_PENDING, self::CONFIRMATION_STATUS_REJECTED];
    protected $guarded = [];

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('images')
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

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
