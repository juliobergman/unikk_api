<?php

namespace Database\Seeders;

use App\Http\Controllers\ExtractIncomeController;
use App\Models\Company;
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
            PeccSeeder::class,
            ContactSeeder::class,
            // MembershipSeeder::class,
            TokenSeeder::class,
            GroupSeeder::class,
            // CategorySeeder::class,
            CategoryIncomeSeeder::class,
            CategoryBalanceSeeder::class,
            FactSeeder::class,
            FormulaSeeder::class,
        ]);

        $company = Company::where('company_id', 1)->first();

        $reports = [
            [
                'income',
                '2022',
                'actual',
            ],
            [
                'income',
                '2022',
                'forecast',
            ],
            [
                'income',
                '2021',
                'actual',
            ],
            [
                'balance',
                '2022',
                'actual',
            ],
            [
                'balance',
                '2022',
                'forecast',
            ],
            [
                'balance',
                '2021',
                'actual',
            ],
        ];

        foreach ($reports as $rep) {
            (new ExtractIncomeController)->index($company, $rep[0],$rep[1],$rep[2],);
        }


    }
}
