<?php
namespace studiobarg\Course\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;


class Course extends Model implements HasMedia
{
    use InteractsWithMedia;
    protected $guarded = [];
    const TAPE_FREE = "free";
    const TAPE_CASH = "cash";
    static $types =[self::TAPE_FREE,self::TAPE_CASH];

    const STATUS_COMPLETED = "completed";
    const STATUS_NOT_COMPLETED = "not-completed";
    const STATUS_LOCKED = "locked";
    static $statuses =[self::STATUS_COMPLETED,self::STATUS_NOT_COMPLETED,self::STATUS_LOCKED];


    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('images')
        ->singleFile()
        ->useDisk('public');
    }


    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb') // ایجاد نسخه تصویر کوچک
        ->width(200)
            ->height(200)
            ->sharpen(10); // تنظیم شفافیت

        $this->addMediaConversion('preview') // ایجاد نسخه پیش‌نمایش
        ->width(600)
            ->height(600);
    }
}
