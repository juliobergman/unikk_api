<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ResultSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $result = [
                [
                    'id' => 1,
                    'chart' => 'barChart',
                    'type' => 'ratio',
                    'name' => "Adjusted Equity",
                    'sparkline' => 'no',
                    'sort' => 1,
                ],[
                    'id' => 2,
                    'chart' => 'barChart',
                    'type' => 'ratio',
                    'name' => "Book Value per Share",
                    'sparkline' => 'no',
                    'sort' => 2,
                ],[
                    'id' => 3,
                    'chart' => 'barChart',
                    'type' => 'ratio',
                    'name' => "Cash Ratio",
                    'sparkline' => 'no',
                    'sort' => 3,
                ],[
                    'id' => 4,
                    'chart' => 'barChart',
                    'type' => 'balance',
                    'name' => "Current Assets",
                    'sparkline' => 'no',
                    'sort' => 4,
                ],[
                    'id' => 5,
                    'chart' => 'barChart',
                    'type' => 'ratio',
                    'name' => "Current Ratio",
                    'sparkline' => 'no',
                    'sort' => 5,
                ],[
                    'id' => 6,
                    'chart' => 'barChart',
                    'type' => 'ratio',
                    'name' => "Debt to Equity",
                    'sparkline' => 'no',
                    'sort' => 6,
                ],[
                    'id' => 7,
                    'chart' => 'barChart',
                    'type' => 'income',
                    'name' => "Depreciation and Amortization",
                    'sparkline' => 'no',
                    'sort' => 7,
                ],[
                    'id' => 8,
                    'chart' => 'barChart',
                    'type' => 'income',
                    'name' => "Direct Operational Cost",
                    'sparkline' => 'no',
                    'sort' => 8,
                ],[
                    'id' => 9,
                    'chart' => 'barChart',
                    'type' => 'income',
                    'name' => "Earning Before Taxes",
                    'sparkline' => 'no',
                    'sort' => 9,
                ],[
                    'id' => 10,
                    'chart' => 'barChart',
                    'type' => 'income',
                    'name' => "EBIT",
                    'sparkline' => 'no',
                    'sort' => 10,
                ],[
                    'id' => 11,
                    'chart' => 'barChart',
                    'type' => 'income',
                    'name' => "EBITDA",
                    'sparkline' => 'no',
                    'sort' => 11,
                ],[
                    'id' => 12,
                    'chart' => 'barChart',
                    'type' => 'ratio',
                    'name' => "EBITDA (%)",
                    'sparkline' => 'no',
                    'sort' => 12,
                ],[
                    'id' => 13,
                    'chart' => 'barChart',
                    'type' => 'balance',
                    'name' => "Equity",
                    'sparkline' => 'no',
                    'sort' => 13,
                ],[
                    'id' => 14,
                    'chart' => 'barChart',
                    'type' => 'income',
                    'name' => "Financial Cost",
                    'sparkline' => 'no',
                    'sort' => 14,
                ],[
                    'id' => 15,
                    'chart' => 'barChart',
                    'type' => 'balance',
                    'name' => "Fixed Assets",
                    'sparkline' => 'no',
                    'sort' => 15,
                ],[
                    'id' => 16,
                    'chart' => 'barChart',
                    'type' => 'income',
                    'name' => "Gross Profit",
                    'sparkline' => 'no',
                    'sort' => 16,
                ],[
                    'id' => 17,
                    'chart' => 'barChart',
                    'type' => 'ratio',
                    'name' => "Gross Profit (%)",
                    'sparkline' => 'no',
                    'sort' => 17,
                ],[
                    'id' => 18,
                    'chart' => 'barChart',
                    'type' => 'income',
                    'name' => "Income",
                    'sparkline' => 'no',
                    'sort' => 18,
                ],[
                    'id' => 19,
                    'chart' => 'barChart',
                    'type' => 'ratio',
                    'name' => "Interest coverage",
                    'sparkline' => 'no',
                    'sort' => 19,
                ],[
                    'id' => 20,
                    'chart' => 'barChart',
                    'type' => 'balance',
                    'name' => "Long-Term Liabilites",
                    'sparkline' => 'no',
                    'sort' => 20,
                ],[
                    'id' => 21,
                    'chart' => 'barChart',
                    'type' => 'income',
                    'name' => "Net Income",
                    'sparkline' => 'no',
                    'sort' => 21,
                ],[
                    'id' => 22,
                    'chart' => 'barChart',
                    'type' => 'ratio',
                    'name' => "Net Income (%)",
                    'sparkline' => 'no',
                    'sort' => 22,
                ],[
                    'id' => 23,
                    'chart' => 'barChart',
                    'type' => 'income',
                    'name' => "Non-company related expenditures/Income",
                    'sparkline' => 'no',
                    'sort' => 23,
                ],[
                    'id' => 24,
                    'chart' => 'barChart',
                    'type' => 'ratio',
                    'name' => "NOPAT",
                    'sparkline' => 'no',
                    'sort' => 24,
                ],[
                    'id' => 25,
                    'chart' => 'barChart',
                    'type' => 'income',
                    'name' => "Operating Expenses",
                    'sparkline' => 'no',
                    'sort' => 25,
                ],[
                    'id' => 26,
                    'chart' => 'barChart',
                    'type' => 'income',
                    'name' => "Operative Income",
                    'sparkline' => 'no',
                    'sort' => 26,
                ],[
                    'id' => 27,
                    'chart' => 'barChart',
                    'type' => 'income',
                    'name' => "Other Income/Expenses",
                    'sparkline' => 'no',
                    'sort' => 27,
                ],[
                    'id' => 28,
                    'chart' => 'barChart',
                    'type' => 'income',
                    'name' => "Other Operational Cost",
                    'sparkline' => 'no',
                    'sort' => 28,
                ],[
                    'id' => 29,
                    'chart' => 'barChart',
                    'type' => 'ratio',
                    'name' => "Return on equity",
                    'sparkline' => 'no',
                    'sort' => 29,
                ],[
                    'id' => 30,
                    'chart' => 'barChart',
                    'type' => 'ratio',
                    'name' => "ROIC",
                    'sparkline' => 'no',
                    'sort' => 30,
                ],[
                    'id' => 31,
                    'chart' => 'barChart',
                    'type' => 'balance',
                    'name' => "Short-term Liabilites",
                    'sparkline' => 'no',
                    'sort' => 31,
                ],[
                    'id' => 32,
                    'chart' => 'barChart',
                    'type' => 'income',
                    'name' => "Taxes",
                    'sparkline' => 'no',
                    'sort' => 32,
                ],[
                    'id' => 33,
                    'chart' => 'barChart',
                    'type' => 'balance',
                    'name' => "Total Assets",
                    'sparkline' => 'no',
                    'sort' => 33,
                ],[
                    'id' => 34,
                    'chart' => 'barChart',
                    'type' => 'balance',
                    'name' => "Total Liabilities",
                    'sparkline' => 'no',
                    'sort' => 34,
                ],[
                    'id' => 35,
                    'chart' => 'barChart',
                    'type' => 'balance',
                    'name' => "Total Liabilities + Equity",
                    'sparkline' => 'no',
                    'sort' => 35,
                ],[
                    'id' => 36,
                    'chart' => 'barChart',
                    'type' => 'ratio',
                    'name' => "Working Capital",
                    'sparkline' => 'no',
                    'sort' => 36,
                ]
            ];

            DB::table('results')->insert($result);
    }
}
