<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        Artisan::call('app:PopulateDateDimensionsTableCommand');

        $this->call([
            UserSeeder::class,
            CountrySeeder::class,
            CurrencySeeder::class,
            CompanySeeder::class,
            CompanyDataSeeder::class,
            CompanyTargetDataSeeder::class,
            CompanySettingsSeeder::class,
            PeccSeeder::class,
            ContactSeeder::class,
        ]);
    }
}
