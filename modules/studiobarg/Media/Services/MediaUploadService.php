<?php

namespace studiobarg\Media\Services;

use studiobarg\Media\Models\Media;

class MediaUploadService
{
    public static function upload($file)
    {

        $extension = strtolower($file->getClientOriginalExtension());
        switch ($extension) {
            case 'jpg':
            case 'jpeg':
            case 'png':
            case 'gif':
                $media = new Media();
                $media->file = imageFileService::upload($file);
                $media->type = 'image';
                $media->user_id = auth()->user()->id;
                $media->filename = $file->getClientOriginalName();

                $media->save();
                return $media;
                break;

            case 'mp4':
            case 'avi':
                videoFileService::upload($file);
                break;

        }
    }
}
