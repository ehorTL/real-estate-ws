<?php

namespace Database\Seeders;

use App\Models\RealEstate\ContractType;
use Illuminate\Database\Seeder;

class ContractTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $contract_types = [
            'rent',
            'sale'
        ];

        foreach ($contract_types as $type) {
            ContractType::create([
                'contract_name' => $type
            ]);
        }
    }
}
