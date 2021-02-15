<?php

namespace App\Services;

use App\Models\RealEstate\RealEstate;
use App\Models\RealEstate\RealEstatePhotoUrl;
use Illuminate\Support\Facades\Storage;

class FileUploaderHelper
{
    public static function deleteMainPhoto($real_estate_object)
    {
        if ($real_estate_object) {
            if ($real_estate_object->main_image_url) {
                if (Storage::exists($real_estate_object->main_image_url)) {
                    Storage::delete($real_estate_object->main_image_url);
                    $real_estate_object->main_image_url = null;
                    $real_estate_object->save();
                }
            }
        }
    }

    /**
     * $obj of type RealEstatePhotoUrl (eloquent model)
     */
    public static function deleteRealEstatePhotoUrl($obj)
    {
        if ($obj) {
            if ($obj->url) {
                if (Storage::exists($obj->url)) {
                    Storage::delete($obj->url);
                }
            }
            $obj->delete();
        }
    }
}
