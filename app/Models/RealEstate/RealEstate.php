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
        // 'inner_id',
        'agent',
        'mobile_number',
        'email',
        // 'real_estate_category_id',
        'main_image_url',
        'contract_type_id',
        'has_commision',

        'realized',
        'currency_id',
        'created_by_user_id',
        'modified_by_user_id',
        'show_in_slider',
        'archieved'
    ];

    protected $with = ['real_estate_categories'];

    public function currency()
    {
    }

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

    public function photo_urls()
    {
        return $this->hasMany(RealEstatePhotoUrl::class, 'real_estate_id', 'id');
    }

    public function real_estate_categories()
    {
        return $this->belongsToMany(
            RealEstateCategory::class,
            'real_estate_real_estate_category',
            'real_estate_id',
            'real_estate_category_id'
        );
    }

    // public function setHasCommisionAttribute($value){
    //     if (config('database.default') == 'pgsql'){
    //         $this->attributes['has_commision'] = $value ? 1 : 0;    
    //     } else {
    //         $this->attributes['has_commision'] = $value ? true : false;
    //     }        
    // }
}
