<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\CompanyData;
use App\Models\CompanyTargetData;
use Illuminate\Database\Seeder;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Company::factory(1)
        ->has(CompanyData::factory())
        ->has(CompanyTargetData::factory())
        ->state([
            'id' => 1,
            'user_id' => 1,
            'company_id' => 1,
            'currency_id' => 2,
            'name' => 'Unikk Ventures',
            'type' => 'active',
        ])
        ->create();
    }
}
