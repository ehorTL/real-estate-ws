<?php

namespace App\Services;

use Image;

class Watermarker
{
    private static function makeImgWatermarked($img_path_from, $img_path_to, $watermark_path)
    {
        $img = Image::make($img_path_from);

        $watermark_obj = Image::make($watermark_path);
        $watermark_obj->opacity(70);
        $img->insert($watermark_obj, 'center');
        // $img->insert($watermark_path, 'center');
        $img->encode('png');
        $img->save($img_path_to);
    }

    /**
     * Adds static watermark picture stored in 'storage/img/static/watermark.png' file
     * to the image provided.
     * Old photo is replaced by new oe with watermark.
     */
    public static function addWatermarkAndSave($file_path)
    {
        $watermark_full_path = public_path('storage/img/static/watermark.png');
        $save_file_to = $file_path;

        self::makeImgWatermarked(
            $file_path,
            $save_file_to,
            $watermark_full_path
        );

        return $save_file_to;
    }
}
