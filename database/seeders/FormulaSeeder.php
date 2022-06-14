<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FormulaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $formulas = [
            [
                'company_id' => '1',
                'type' => 'income',
                'table' => 'category',
                'group_id' => '3',
                'category_id' => '6',
                'identifier' => 'ebit_financial_cost',
                'category_name' => 'Financial Cost',
                'group_name' => 'Earning Before Taxes',
            ],
            [
                'company_id' => '1',
                'type' => 'income',
                'table' => 'category',
                'group_id' => '4',
                'category_id' => '9',
                'identifier' => 'ebit_taxes',
                'category_name' => 'Taxes',
                'group_name' => 'Net Income',
            ],
            [
                'company_id' => '1',
                'type' => 'income',
                'table' => 'category',
                'group_id' => '2',
                'category_id' => '5',
                'identifier' => 'ebit_da',
                'category_name' => 'Depreciation and Amortization',
                'group_name' => 'Operative Income',
            ],
            [
                'company_id' => '1',
                'type' => 'balance',
                'table' => 'category',
                'group_id' => '5',
                'category_id' => '132',
                'identifier' => 'total_current_assets',
                'category_name' => 'Current Assets',
                'group_name' => 'Assets',
            ],
            [
                'company_id' => '1',
                'type' => 'balance',
                'table' => 'category',
                'group_id' => '6',
                'category_id' => '134',
                'identifier' => 'short_term_liabilities',
                'category_name' => 'Short-term Liabilites',
                'group_name' => 'Liabilities',
            ],
            [
                'company_id' => '1',
                'type' => 'balance',
                'table' => 'category',
                'group_id' => '5',
                'category_id' => '137',
                'identifier' => 'cash_and_cash_equivalents',
                'category_name' => 'Cash and cash equivalents',
                'group_name' => 'Assets',
            ],
            [
                'company_id' => '1',
                'type' => 'balance',
                'table' => 'category',
                'group_id' => '5',
                'category_id' => '138',
                'identifier' => 'short_term_assets_listed_stock_exchange',
                'category_name' => 'Short-term Assets listed Stock Exchange',
                'group_name' => 'Assets',
            ],
            [
                'company_id' => '1',
                'type' => 'income',
                'table' => 'category',
                'group_id' => '1',
                'category_id' => '1',
                'identifier' => 'income',
                'category_name' => 'Income',
                'group_name' => 'Gross Profit',
            ],
            [
                'company_id' => '1',
                'type' => 'income',
                'table' => 'category',
                'group_id' => '3',
                'category_id' => '122',
                'identifier' => 'interest_expenses',
                'category_name' => 'Interest expenses on loans',
                'group_name' => 'Earning Before Taxes',
            ],
        ];

        DB::table('formulas')->insert($formulas);

    }
}

