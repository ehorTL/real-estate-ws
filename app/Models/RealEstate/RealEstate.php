<?php

namespace App\Models\RealEstate;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RealEstate extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'price',
        'price_per_square_meter',
        'square',
        'address',
        'inner_id',
        'agent',
        'mobile_number',
        'email',
        // 'category',
        'main_image_url',
        'contract_type',
        'has_commision',
    ];

    public function setPriceAttributeAttribute($value)
    {
        $value = intval($value * 100) / 100;
        $this->attributes['price'] = $value;
    }

    public function setPricePerSquareMeterAttribute($value)
    {
        $value = intval($value * 100) / 100;
        $this->attributes['price_per_square_meter'] = $value;
    }

    public function setSquareAttribute($value)
    {
        $value = intval($value * 1000) / 1000;
        $this->attributes['square'] = $value;
    }
}
