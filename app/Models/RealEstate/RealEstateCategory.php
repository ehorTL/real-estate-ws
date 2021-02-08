<?php

namespace App\Models\RealEstate;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RealEstateCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_name',
    ];
}
