<?php

namespace studiobarg\Media\Services;

use Illuminate\Support\Facades\Storage;
use Intervention\Image\Image;
use Intervention\Image\ImageManager;

class imageFileService

{
    protected static $sizes = [300, 600];

    public static function upload($file)
    {
        $manager = new ImageManager();

        // تولید نام یکتا برای فایل
        $fileName = uniqid();
        $extension = $file->extension();
        $dir = 'uploads/'; // مسیر داخل storage/app/public/uploads

        // ذخیره فایل اصلی در storage/app/public/uploads
        $originalPath = $file->storeAs($dir, "$fileName.$extension", 'public');

        // مسیر کامل فایل اصلی
        $storagePath = storage_path("app/public/{$originalPath}");

        // بررسی وجود فایل
        if (!file_exists($storagePath)) {
            throw new \Exception("File does not exist: $storagePath");
        }

        // تغییر اندازه و ذخیره نسخه‌های مختلف تصویر
        $resizedImages = self::resize($storagePath, $dir, $fileName, $extension);

        // مسیر نهایی برای نمایش در مرورگر
        return [
            'original' => Storage::url($originalPath),
            'resized' => $resizedImages,
        ];
    }

    public static function resize($imgPath, $dir, $fileName, $extension)
    {
        $manager = new ImageManager();
        $img = $manager->read($imgPath);
        $resizedImages = [];

        foreach (self::$sizes as $size) {
            $resizedFileName = "{$fileName}_{$size}.{$extension}";
            $resizedPath = storage_path("app/public/{$dir}{$resizedFileName}");

            // تغییر اندازه و حفظ نسبت تصویر
            $img->resize($size, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save($resizedPath);

            // ذخیره مسیر برای نمایش در مرورگر
            $resizedImages[$size] = Storage::url("{$dir}{$resizedFileName}");
        }

        return $resizedImages;
    }
}
