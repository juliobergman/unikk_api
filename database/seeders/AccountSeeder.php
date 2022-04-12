<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class AccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
           
        $codes = [
            [
                'id' => 39,
                'company_id' => 1,
                'name' => 'Income from Services',
                'parent_id' => 10,
                'sort' => 1,
                'account' => 3400,
            ],
            [
                'id' => 40,
                'company_id' => 1,
                'name' => 'Revenue Dividends Income',
                'parent_id' => 11,
                'sort' => 2,
                'account' => 3410,
            ],
            [
                'id' => 41,
                'company_id' => 1,
                'name' => 'Revenue Unrealized gains in trading securities',
                'parent_id' => 11,
                'sort' => 3,
                'account' => 3415,
            ],
            [
                'id' => 42,
                'company_id' => 1,
                'name' => 'Earnings from short-term financial investments',
                'parent_id' => 11,
                'sort' => 4,
                'account' => 3420,
            ],
            [
                'id' => 43,
                'company_id' => 1,
                'name' => 'Realized gains in  Private equity Holdings',
                'parent_id' => 12,
                'sort' => 5,
                'account' => 3425,
            ],
            [
                'id' => 44,
                'company_id' => 1,
                'name' => 'Interest gains from AFS debt investments',
                'parent_id' => 13,
                'sort' => 6,
                'account' => 3430,
            ],
            [
                'id' => 45,
                'company_id' => 1,
                'name' => 'Realized gains on AFS debt invesments',
                'parent_id' => 13,
                'sort' => 7,
                'account' => 3435,
            ],
            [
                'id' => 46,
                'company_id' => 1,
                'name' => 'Return on bank deposits',
                'parent_id' => 14,
                'sort' => 8,
                'account' => 3440,
            ],
            [
                'id' => 47,
                'company_id' => 1,
                'name' => 'Exchange gains',
                'parent_id' => 14,
                'sort' => 9,
                'account' => 3445,
            ],
            [
                'id' => 48,
                'company_id' => 1,
                'name' => 'Other Interest gains',
                'parent_id' => 14,
                'sort' => 10,
                'account' => 3450,
            ],
            [
                'id' => 49,
                'company_id' => 1,
                'name' => 'Revenue from Royalties',
                'parent_id' => 15,
                'sort' => 11,
                'account' => 3455,
            ],
            [
                'id' => 50,
                'company_id' => 1,
                'name' => 'Revenue from IP sales',
                'parent_id' => 15,
                'sort' => 12,
                'account' => 3460,
            ],
            [
                'id' => 51,
                'company_id' => 1,
                'name' => 'Gains on Cryptocurrency holdings value',
                'parent_id' => 16,
                'sort' => 13,
                'account' => 3465,
            ],
            [
                'id' => 52,
                'company_id' => 1,
                'name' => 'Discount',
                'parent_id' => 17,
                'sort' => 14,
                'account' => 3490,
            ],
            [
                'id' => 53,
                'company_id' => 1,
                'name' => 'Rebates and price deductions',
                'parent_id' => 17,
                'sort' => 15,
                'account' => 3491,
            ],
            [
                'id' => 54,
                'company_id' => 1,
                'name' => 'Losses from receivables',
                'parent_id' => 17,
                'sort' => 16,
                'account' => 3495,
            ],
            [
                'id' => 55,
                'company_id' => 1,
                'name' => 'Costs of services',
                'parent_id' => 18,
                'sort' => 17,
                'account' => 4400,
            ],
            [
                'id' => 56,
                'company_id' => 1,
                'name' => 'Investments Comision',
                'parent_id' => 18,
                'sort' => 18,
                'account' => 4410,
            ],
            [
                'id' => 57,
                'company_id' => 1,
                'name' => 'Management fees',
                'parent_id' => 18,
                'sort' => 19,
                'account' => 4415,
            ],
            [
                'id' => 58,
                'company_id' => 1,
                'name' => 'Brokerage Comissions',
                'parent_id' => 18,
                'sort' => 20,
                'account' => 4420,
            ],
            [
                'id' => 59,
                'company_id' => 1,
                'name' => 'Management fees Private equity',
                'parent_id' => 18,
                'sort' => 21,
                'account' => 4425,
            ],
            [
                'id' => 60,
                'company_id' => 1,
                'name' => 'Interest from leveraged investments',
                'parent_id' => 18,
                'sort' => 22,
                'account' => 4430,
            ],
            [
                'id' => 61,
                'company_id' => 1,
                'name' => 'Bank investments comissions (Private Equity)',
                'parent_id' => 18,
                'sort' => 23,
                'account' => 4435,
            ],
            [
                'id' => 62,
                'company_id' => 1,
                'name' => 'Other Investments Comissions',
                'parent_id' => 18,
                'sort' => 24,
                'account' => 4440,
            ],
            [
                'id' => 63,
                'company_id' => 1,
                'name' => 'Labor fees',
                'parent_id' => 19,
                'sort' => 25,
                'account' => 3600,
            ],
            [
                'id' => 64,
                'company_id' => 1,
                'name' => 'Techological tools Cost',
                'parent_id' => 19,
                'sort' => 26,
                'account' => 3610,
            ],
            [
                'id' => 65,
                'company_id' => 1,
                'name' => 'Bank comissions',
                'parent_id' => 19,
                'sort' => 27,
                'account' => 3615,
            ],
            [
                'id' => 66,
                'company_id' => 1,
                'name' => 'Other incubation cost',
                'parent_id' => 19,
                'sort' => 28,
                'account' => 3620,
            ],
            [
                'id' => 67,
                'company_id' => 1,
                'name' => 'Salary cost Services',
                'parent_id' => 20,
                'sort' => 29,
                'account' => 5400,
            ],
            [
                'id' => 68,
                'company_id' => 1,
                'name' => 'Allowances Services',
                'parent_id' => 20,
                'sort' => 30,
                'account' => 5401,
            ],
            [
                'id' => 69,
                'company_id' => 1,
                'name' => 'Bonuses Services',
                'parent_id' => 20,
                'sort' => 31,
                'account' => 5402,
            ],
            [
                'id' => 70,
                'company_id' => 1,
                'name' => 'Commissions Services',
                'parent_id' => 20,
                'sort' => 32,
                'account' => 5403,
            ],
            [
                'id' => 71,
                'company_id' => 1,
                'name' => 'Social security benefits ',
                'parent_id' => 20,
                'sort' => 33,
                'account' => 5405,
            ],
            [
                'id' => 72,
                'company_id' => 1,
                'name' => 'Director Fees',
                'parent_id' => 20,
                'sort' => 34,
                'account' => 5409,
            ],
            [
                'id' => 73,
                'company_id' => 1,
                'name' => 'AHV, IV, EO, ALV',
                'parent_id' => 21,
                'sort' => 35,
                'account' => 5700,
            ],
            [
                'id' => 74,
                'company_id' => 1,
                'name' => 'FAK',
                'parent_id' => 21,
                'sort' => 36,
                'account' => 5710,
            ],
            [
                'id' => 75,
                'company_id' => 1,
                'name' => 'Occupational pension',
                'parent_id' => 21,
                'sort' => 37,
                'account' => 5720,
            ],
            [
                'id' => 76,
                'company_id' => 1,
                'name' => 'Accident insurance',
                'parent_id' => 21,
                'sort' => 38,
                'account' => 5730,
            ],
            [
                'id' => 77,
                'company_id' => 1,
                'name' => 'Daily sickness insurance',
                'parent_id' => 21,
                'sort' => 39,
                'account' => 5740,
            ],
            [
                'id' => 78,
                'company_id' => 1,
                'name' => 'Tax at source',
                'parent_id' => 21,
                'sort' => 40,
                'account' => 5790,
            ],
            [
                'id' => 79,
                'company_id' => 1,
                'name' => 'Staff recruitment',
                'parent_id' => 22,
                'sort' => 41,
                'account' => 5800,
            ],
            [
                'id' => 80,
                'company_id' => 1,
                'name' => 'Vocational education and traiding',
                'parent_id' => 22,
                'sort' => 42,
                'account' => 5810,
            ],
            [
                'id' => 81,
                'company_id' => 1,
                'name' => 'Other employee expenses',
                'parent_id' => 22,
                'sort' => 43,
                'account' => 5880,
            ],
            [
                'id' => 82,
                'company_id' => 1,
                'name' => 'Rent',
                'parent_id' => 23,
                'sort' => 44,
                'account' => 6000,
            ],
            [
                'id' => 83,
                'company_id' => 1,
                'name' => 'Expenses Furnishings and equipment',
                'parent_id' => 24,
                'sort' => 45,
                'account' => 6101,
            ],
            [
                'id' => 84,
                'company_id' => 1,
                'name' => 'Leasing tangible fixed assets',
                'parent_id' => 24,
                'sort' => 46,
                'account' => 6160,
            ],
            [
                'id' => 85,
                'company_id' => 1,
                'name' => 'Vehicle repair, service',
                'parent_id' => 25,
                'sort' => 47,
                'account' => 6200,
            ],
            [
                'id' => 86,
                'company_id' => 1,
                'name' => 'Vehicle fuel',
                'parent_id' => 25,
                'sort' => 48,
                'account' => 6210,
            ],
            [
                'id' => 87,
                'company_id' => 1,
                'name' => 'Vehicle insurance / vehicle tax',
                'parent_id' => 25,
                'sort' => 49,
                'account' => 6220,
            ],
            [
                'id' => 88,
                'company_id' => 1,
                'name' => 'Vehicle leasing',
                'parent_id' => 25,
                'sort' => 50,
                'account' => 6260,
            ],
            [
                'id' => 89,
                'company_id' => 1,
                'name' => 'Private share Vehicle expenses',
                'parent_id' => 25,
                'sort' => 51,
                'account' => 6270,
            ],
            [
                'id' => 90,
                'company_id' => 1,
                'name' => 'Insurance premiums',
                'parent_id' => 26,
                'sort' => 52,
                'account' => 6300,
            ],
            [
                'id' => 91,
                'company_id' => 1,
                'name' => 'Duties and charges',
                'parent_id' => 26,
                'sort' => 53,
                'account' => 6360,
            ],
            [
                'id' => 92,
                'company_id' => 1,
                'name' => 'Electricity/water/gas',
                'parent_id' => 27,
                'sort' => 54,
                'account' => 6400,
            ],
            [
                'id' => 93,
                'company_id' => 1,
                'name' => 'Office material',
                'parent_id' => 28,
                'sort' => 55,
                'account' => 6500,
            ],
            [
                'id' => 94,
                'company_id' => 1,
                'name' => 'Magazines, books',
                'parent_id' => 28,
                'sort' => 56,
                'account' => 6503,
            ],
            [
                'id' => 95,
                'company_id' => 1,
                'name' => 'Telephone, internet',
                'parent_id' => 28,
                'sort' => 57,
                'account' => 6510,
            ],
            [
                'id' => 96,
                'company_id' => 1,
                'name' => 'Postage',
                'parent_id' => 28,
                'sort' => 58,
                'account' => 6513,
            ],
            [
                'id' => 97,
                'company_id' => 1,
                'name' => 'Contributions, donations',
                'parent_id' => 28,
                'sort' => 59,
                'account' => 6520,
            ],
            [
                'id' => 98,
                'company_id' => 1,
                'name' => 'Accounting expenses',
                'parent_id' => 28,
                'sort' => 60,
                'account' => 6530,
            ],
            [
                'id' => 99,
                'company_id' => 1,
                'name' => 'Legal consulting',
                'parent_id' => 28,
                'sort' => 61,
                'account' => 6531,
            ],
            [
                'id' => 100,
                'company_id' => 1,
                'name' => 'Tax consulting',
                'parent_id' => 28,
                'sort' => 62,
                'account' => 6532,
            ],
            [
                'id' => 101,
                'company_id' => 1,
                'name' => 'Other consulting expenses',
                'parent_id' => 28,
                'sort' => 63,
                'account' => 6533,
            ],
            [
                'id' => 102,
                'company_id' => 1,
                'name' => 'Gsuites expenses',
                'parent_id' => 28,
                'sort' => 64,
                'account' => 6540,
            ],
            [
                'id' => 103,
                'company_id' => 1,
                'name' => 'Cloud Storage expenses',
                'parent_id' => 28,
                'sort' => 65,
                'account' => 6550,
            ],
            [
                'id' => 104,
                'company_id' => 1,
                'name' => 'Leasing and rent HW + SW',
                'parent_id' => 28,
                'sort' => 66,
                'account' => 6560,
            ],
            [
                'id' => 105,
                'company_id' => 1,
                'name' => 'Licenses and maintenance',
                'parent_id' => 28,
                'sort' => 67,
                'account' => 6570,
            ],
            [
                'id' => 106,
                'company_id' => 1,
                'name' => 'Advertising',
                'parent_id' => 29,
                'sort' => 68,
                'account' => 6600,
            ],
            [
                'id' => 107,
                'company_id' => 1,
                'name' => 'Promotional print material',
                'parent_id' => 29,
                'sort' => 69,
                'account' => 6610,
            ],
            [
                'id' => 108,
                'company_id' => 1,
                'name' => 'Exhibitions / decoration',
                'parent_id' => 29,
                'sort' => 70,
                'account' => 6620,
            ],
            [
                'id' => 109,
                'company_id' => 1,
                'name' => 'Web Hostung services',
                'parent_id' => 29,
                'sort' => 71,
                'account' => 6630,
            ],
            [
                'id' => 110,
                'company_id' => 1,
                'name' => 'Travel expenses',
                'parent_id' => 29,
                'sort' => 72,
                'account' => 6640,
            ],
            [
                'id' => 111,
                'company_id' => 1,
                'name' => 'Representation expenses ',
                'parent_id' => 29,
                'sort' => 73,
                'account' => 6641,
            ],
            [
                'id' => 112,
                'company_id' => 1,
                'name' => 'Customer gifts',
                'parent_id' => 29,
                'sort' => 74,
                'account' => 6642,
            ],
            [
                'id' => 113,
                'company_id' => 1,
                'name' => 'Other expenses',
                'parent_id' => 30,
                'sort' => 75,
                'account' => 6700,
            ],
            [
                'id' => 114,
                'company_id' => 1,
                'name' => 'Depreciation on financial assets',
                'parent_id' => 31,
                'sort' => 76,
                'account' => 6800,
            ],
            [
                'id' => 115,
                'company_id' => 1,
                'name' => 'Depreciation on machinery and appliances',
                'parent_id' => 31,
                'sort' => 77,
                'account' => 6820,
            ],
            [
                'id' => 116,
                'company_id' => 1,
                'name' => 'Depreciation on furniture and equipment',
                'parent_id' => 31,
                'sort' => 78,
                'account' => 6821,
            ],
            [
                'id' => 117,
                'company_id' => 1,
                'name' => 'Depreciation on office equipment and computers',
                'parent_id' => 31,
                'sort' => 79,
                'account' => 6822,
            ],
            [
                'id' => 118,
                'company_id' => 1,
                'name' => 'Depreciation on vehicles',
                'parent_id' => 31,
                'sort' => 80,
                'account' => 6823,
            ],
            [
                'id' => 119,
                'company_id' => 1,
                'name' => 'Depreciation on immovable fixes assets',
                'parent_id' => 31,
                'sort' => 81,
                'account' => 6830,
            ],
            [
                'id' => 120,
                'company_id' => 1,
                'name' => 'Depreciation on intangible assets',
                'parent_id' => 31,
                'sort' => 82,
                'account' => 6840,
            ],
            [
                'id' => 121,
                'company_id' => 1,
                'name' => 'Depreciation on capitalized expenditure',
                'parent_id' => 31,
                'sort' => 83,
                'account' => 6850,
            ],
            [
                'id' => 122,
                'company_id' => 1,
                'name' => 'Interest expenses on loans',
                'parent_id' => 32,
                'sort' => 84,
                'account' => 6901,
            ],
            [
                'id' => 123,
                'company_id' => 1,
                'name' => 'Other Bank Charges',
                'parent_id' => 32,
                'sort' => 85,
                'account' => 6940,
            ],
            [
                'id' => 124,
                'company_id' => 1,
                'name' => 'Exchange losses',
                'parent_id' => 32,
                'sort' => 86,
                'account' => 6949,
            ],
            [
                'id' => 125,
                'company_id' => 1,
                'name' => 'Rental income',
                'parent_id' => 33,
                'sort' => 87,
                'account' => 7500,
            ],
            [
                'id' => 126,
                'company_id' => 1,
                'name' => 'Property expenses',
                'parent_id' => 33,
                'sort' => 88,
                'account' => 7510,
            ],
            [
                'id' => 127,
                'company_id' => 1,
                'name' => 'Gains on tangible fixed assets',
                'parent_id' => 34,
                'sort' => 89,
                'account' => 7910,
            ],
            [
                'id' => 128,
                'company_id' => 1,
                'name' => 'Non-company related expenditures',
                'parent_id' => 35,
                'sort' => 90,
                'account' => 8000,
            ],
            [
                'id' => 129,
                'company_id' => 1,
                'name' => 'Non-company related income',
                'parent_id' => 36,
                'sort' => 91,
                'account' => 8100,
            ],
            [
                'id' => 130,
                'company_id' => 1,
                'name' => 'Cantonal and municipal taxes',
                'parent_id' => 37,
                'sort' => 92,
                'account' => 8900,
            ],
            [
                'id' => 131,
                'company_id' => 1,
                'name' => 'Direct federal taxes',
                'parent_id' => 38,
                'sort' => 93,
                'account' => 8901,
            ]
        ];
    }
}