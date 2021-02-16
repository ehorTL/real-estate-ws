<?php

namespace Database\Seeders;

use App\Models\Currency\Currency;
use Illuminate\Database\Seeder;

class CurrencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $currency = [
            'UDS', 'UAH'
        ];

        foreach ($currency as $c) {
            Currency::create([
                'currency_name' => $c
            ]);
        }
    }
}
