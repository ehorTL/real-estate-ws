<?php

namespace App\Models\RealEstate;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RealEstatePhotoUrl extends Model
{
    use HasFactory;

    protected $table = 'real_estate_photo_urls';


    protected $fillable = [
        'url',
        'real_estate_id',
    ];
}
