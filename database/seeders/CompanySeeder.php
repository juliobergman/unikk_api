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
        
        // Active
        Company::factory(1)
        ->has(CompanyData::factory()
            ->state([
                'logo' => env('COMPANY_LOGO'),
                'country' => env('COMPANY_COUNTRY'),
            ])
        )
        ->has(CompanyTargetData::factory())
        ->state([
            'id' => 1,
            'user_id' => 1,
            'company_id' => 1,
            'name' => env('COMPANY_NAME'),
            'type' => 'active',
        ])
        ->create();


        // Targets
        // Company::factory(25)
        // ->has(CompanyData::factory())
        // ->has(CompanyTargetData::factory())
        // ->state([
        //     // 'id' => 1,
        //     'user_id' => 1,
        //     'company_id' => 1,
        //     // 'name' => 'Unikk Ventures',
        //     'type' => 'target',
        // ])
        // ->create();
    }
}
