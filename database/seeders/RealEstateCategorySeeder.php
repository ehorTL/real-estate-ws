<?php

namespace Database\Seeders;

use App\Models\RealEstate\RealEstateCategory;
use Illuminate\Database\Seeder;

class RealEstateCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            'Офисы',
            'Здания',
            'Магазины',
            'Рестораны',
            'Доходная недвижимость',
        ];

        foreach ($categories as $category) {
            RealEstateCategory::create([
                'category_name' => $category
            ]);
        }
    }
}
