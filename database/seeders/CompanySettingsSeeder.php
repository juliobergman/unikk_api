<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CompanySettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $settings = [
            [
                'company_id' => 1,
                'name' => 'Effective Tax Rate',
                'type' => 'float',
                'category' => 'financial',
                'selector' => 'financial_ratio',
                'value' => 10,
            ],
            [
                'company_id' => 1,
                'name' => 'Number of shares',
                'type' => 'float',
                'category' => 'financial',
                'selector' => 'financial_ratio',
                'value' => 100,
            ]
        ];

        DB::table('company_settings')->insert($settings);
    }
}
