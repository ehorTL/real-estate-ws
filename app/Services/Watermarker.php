<?php

namespace App\Services;

use Image;

class Watermarker
{
    private static function makeImgWatermarked($img_path_from, $img_path_to, $watermark_path)
    {
        $img = Image::make($img_path_from);
        self::minifyImg($img);

        $watermark_img = Image::make($watermark_path);
        self::fitWatermarkToImg($img, $watermark_img, 2);

        $watermark_img->opacity(70);
        $img->insert($watermark_img, 'center');
        // $img->encode('png');
        $img->save($img_path_to);
    }

    /**
     * @param Image main_img Image the watermark to be attached to.
     * @param Image $watermark_img Waterwark image object
     */
    private static function fitWatermarkToImg($main_img, $watermark_img, $factor)
    {
        $wtm_height_needed = intval(round($main_img->height() / $factor));
        $watermark_img->heighten($wtm_height_needed);
    }

    private static function minifyImg($img, $max_height = 720)
    {
        if ($img->height() > $max_height) {
            $img->heighten($max_height);
        }
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
