<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CurrencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $currencies = [
            [
                'name' => 'Leke',
                'code' => 'ALL',
                'symbol' => 'Lek',
            ],
            [
                'name' => 'Dollars',
                'code' => 'USD',
                'symbol' => '$',
            ],
            [
                'name' => 'Afghanis',
                'code' => 'AFN',
                'symbol' => '؋',
            ],
            [
                'name' => 'Pesos',
                'code' => 'ARS',
                'symbol' => '$',
            ],
            [
                'name' => 'Guilders',
                'code' => 'AWG',
                'symbol' => 'ƒ',
            ],
            [
                'name' => 'Dollars',
                'code' => 'AUD',
                'symbol' => '$',
            ],
            [
                'name' => 'New Manats',
                'code' => 'AZN',
                'symbol' => 'ман',
            ],
            [
                'name' => 'Dollars',
                'code' => 'BSD',
                'symbol' => '$',
            ],
            [
                'name' => 'Dollars',
                'code' => 'BBD',
                'symbol' => '$',
            ],
            [
                'name' => 'Rubles',
                'code' => 'BYR',
                'symbol' => 'p.',
            ],
            [
                'name' => 'Euro',
                'code' => 'EUR',
                'symbol' => '€',
            ],
            [
                'name' => 'Dollars',
                'code' => 'BZD',
                'symbol' => 'BZ$',
            ],
            [
                'name' => 'Dollars',
                'code' => 'BMD',
                'symbol' => '$',
            ],
            [
                'name' => 'Bolivianos',
                'code' => 'BOB',
                'symbol' => '$b',
            ],
            [
                'name' => 'Convertible Marka',
                'code' => 'BAM',
                'symbol' => 'KM',
            ],
            [
                'name' => 'Pula',
                'code' => 'BWP',
                'symbol' => 'P',
            ],
            [
                'name' => 'Leva',
                'code' => 'BGN',
                'symbol' => 'лв',
            ],
            [
                'name' => 'Reais',
                'code' => 'BRL',
                'symbol' => 'R$',
            ],
            [
                'name' => 'Pounds',
                'code' => 'GBP',
                'symbol' => '£',
            ],
            [
                'name' => 'Dollars',
                'code' => 'BND',
                'symbol' => '$',
            ],
            [
                'name' => 'Riels',
                'code' => 'KHR',
                'symbol' => '៛',
            ],
            [
                'name' => 'Dollars',
                'code' => 'CAD',
                'symbol' => '$',
            ],
            [
                'name' => 'Dollars',
                'code' => 'KYD',
                'symbol' => '$',
            ],
            [
                'name' => 'Pesos',
                'code' => 'CLP',
                'symbol' => '$',
            ],
            [
                'name' => 'Yuan Renminbi',
                'code' => 'CNY',
                'symbol' => '¥',
            ],
            [
                'name' => 'Pesos',
                'code' => 'COP',
                'symbol' => '$',
            ],
            [
                'name' => 'Colón',
                'code' => 'CRC',
                'symbol' => '₡',
            ],
            [
                'name' => 'Kuna',
                'code' => 'HRK',
                'symbol' => 'kn',
            ],
            [
                'name' => 'Pesos',
                'code' => 'CUP',
                'symbol' => '₱',
            ],
            [
                'name' => 'Koruny',
                'code' => 'CZK',
                'symbol' => 'Kč',
            ],
            [
                'name' => 'Kroner',
                'code' => 'DKK',
                'symbol' => 'kr',
            ],
            [
                'name' => 'Pesos',
                'code' => 'DOP',
                'symbol' => 'RD$',
            ],
            [
                'name' => 'Dollars',
                'code' => 'XCD',
                'symbol' => '$',
            ],
            [
                'name' => 'Pounds',
                'code' => 'EGP',
                'symbol' => '£',
            ],
            [
                'name' => 'Colones',
                'code' => 'SVC',
                'symbol' => '$',
            ],
            [
                'name' => 'Pounds',
                'code' => 'FKP',
                'symbol' => '£',
            ],
            [
                'name' => 'Dollars',
                'code' => 'FJD',
                'symbol' => '$',
            ],
            [
                'name' => 'Cedis',
                'code' => 'GHC',
                'symbol' => '¢',
            ],
            [
                'name' => 'Pounds',
                'code' => 'GIP',
                'symbol' => '£',
            ],
            [
                'name' => 'Quetzales',
                'code' => 'GTQ',
                'symbol' => 'Q',
            ],
            [
                'name' => 'Pounds',
                'code' => 'GGP',
                'symbol' => '£',
            ],
            [
                'name' => 'Dollars',
                'code' => 'GYD',
                'symbol' => '$',
            ],
            [
                'name' => 'Lempiras',
                'code' => 'HNL',
                'symbol' => 'L',
            ],
            [
                'name' => 'Dollars',
                'code' => 'HKD',
                'symbol' => '$',
            ],
            [
                'name' => 'Forint',
                'code' => 'HUF',
                'symbol' => 'Ft',
            ],
            [
                'name' => 'Kronur',
                'code' => 'ISK',
                'symbol' => 'kr',
            ],
            [
                'name' => 'Rupees',
                'code' => 'INR',
                'symbol' => 'Rp',
            ],
            [
                'name' => 'Rupiahs',
                'code' => 'IDR',
                'symbol' => 'Rp',
            ],
            [
                'name' => 'Rials',
                'code' => 'IRR',
                'symbol' => '﷼',
            ],
            [
                'name' => 'Pounds',
                'code' => 'IMP',
                'symbol' => '£',
            ],
            [
                'name' => 'New Shekels',
                'code' => 'ILS',
                'symbol' => '₪',
            ],
            [
                'name' => 'Dollars',
                'code' => 'JMD',
                'symbol' => 'J$',
            ],
            [
                'name' => 'Yen',
                'code' => 'JPY',
                'symbol' => '¥',
            ],
            [
                'name' => 'Pounds',
                'code' => 'JEP',
                'symbol' => '£',
            ],
            [
                'name' => 'Tenge',
                'code' => 'KZT',
                'symbol' => 'лв',
            ],
            [
                'name' => 'Won',
                'code' => 'KPW',
                'symbol' => '₩',
            ],
            [
                'name' => 'Won',
                'code' => 'KRW',
                'symbol' => '₩',
            ],
            [
                'name' => 'Soms',
                'code' => 'KGS',
                'symbol' => 'лв',
            ],
            [
                'name' => 'Kips',
                'code' => 'LAK',
                'symbol' => '₭',
            ],
            [
                'name' => 'Lati',
                'code' => 'LVL',
                'symbol' => 'Ls',
            ],
            [
                'name' => 'Pounds',
                'code' => 'LBP',
                'symbol' => '£',
            ],
            [
                'name' => 'Dollars',
                'code' => 'LRD',
                'symbol' => '$',
            ],
            [
                'name' => 'Switzerland Francs',
                'code' => 'CHF',
                'symbol' => 'CHF',
            ],
            [
                'name' => 'Litai',
                'code' => 'LTL',
                'symbol' => 'Lt',
            ],
            [
                'name' => 'Denars',
                'code' => 'MKD',
                'symbol' => 'ден',
            ],
            [
                'name' => 'Ringgits',
                'code' => 'MYR',
                'symbol' => 'RM',
            ],
            [
                'name' => 'Rupees',
                'code' => 'MUR',
                'symbol' => '₨',
            ],
            [
                'name' => 'Pesos',
                'code' => 'MXN',
                'symbol' => '$',
            ],
            [
                'name' => 'Tugriks',
                'code' => 'MNT',
                'symbol' => '₮',
            ],
            [
                'name' => 'Meticais',
                'code' => 'MZN',
                'symbol' => 'MT',
            ],
            [
                'name' => 'Dollars',
                'code' => 'NAD',
                'symbol' => '$',
            ],
            [
                'name' => 'Rupees',
                'code' => 'NPR',
                'symbol' => '₨',
            ],
            [
                'name' => 'Guilders',
                'code' => 'ANG',
                'symbol' => 'ƒ',
            ],
            [
                'name' => 'Dollars',
                'code' => 'NZD',
                'symbol' => '$',
            ],
            [
                'name' => 'Cordobas',
                'code' => 'NIO',
                'symbol' => 'C$',
            ],
            [
                'name' => 'Nairas',
                'code' => 'NGN',
                'symbol' => '₦',
            ],
            [
                'name' => 'Krone',
                'code' => 'NOK',
                'symbol' => 'kr',
            ],
            [
                'name' => 'Rials',
                'code' => 'OMR',
                'symbol' => '﷼',
            ],
            [
                'name' => 'Rupees',
                'code' => 'PKR',
                'symbol' => '₨',
            ],
            [
                'name' => 'Balboa',
                'code' => 'PAB',
                'symbol' => 'B/.',
            ],
            [
                'name' => 'Guarani',
                'code' => 'PYG',
                'symbol' => 'Gs',
            ],
            [
                'name' => 'Nuevos Soles',
                'code' => 'PEN',
                'symbol' => 'S/.',
            ],
            [
                'name' => 'Pesos',
                'code' => 'PHP',
                'symbol' => 'Php',
            ],
            [
                'name' => 'Zlotych',
                'code' => 'PLN',
                'symbol' => 'zł',
            ],
            [
                'name' => 'Rials',
                'code' => 'QAR',
                'symbol' => '﷼',
            ],
            [
                'name' => 'New Lei',
                'code' => 'RON',
                'symbol' => 'lei',
            ],
            [
                'name' => 'Rubles',
                'code' => 'RUB',
                'symbol' => 'руб',
            ],
            [
                'name' => 'Pounds',
                'code' => 'SHP',
                'symbol' => '£',
            ],
            [
                'name' => 'Riyals',
                'code' => 'SAR',
                'symbol' => '﷼',
            ],
            [
                'name' => 'Dinars',
                'code' => 'RSD',
                'symbol' => 'Дин.',
            ],
            [
                'name' => 'Rupees',
                'code' => 'SCR',
                'symbol' => '₨',
            ],
            [
                'name' => 'Dollars',
                'code' => 'SGD',
                'symbol' => '$',
            ],
            [
                'name' => 'Dollars',
                'code' => 'SBD',
                'symbol' => '$',
            ],
            [
                'name' => 'Shillings',
                'code' => 'SOS',
                'symbol' => 'S',
            ],
            [
                'name' => 'Rand',
                'code' => 'ZAR',
                'symbol' => 'R',
            ],
            [
                'name' => 'Rupees',
                'code' => 'LKR',
                'symbol' => '₨',
            ],
            [
                'name' => 'Kronor',
                'code' => 'SEK',
                'symbol' => 'kr',
            ],
            [
                'name' => 'Dollars',
                'code' => 'SRD',
                'symbol' => '$',
            ],
            [
                'name' => 'Pounds',
                'code' => 'SYP',
                'symbol' => '£',
            ],
            [
                'name' => 'New Dollars',
                'code' => 'TWD',
                'symbol' => 'NT$',
            ],
            [
                'name' => 'Baht',
                'code' => 'THB',
                'symbol' => '฿',
            ],
            [
                'name' => 'Dollars',
                'code' => 'TTD',
                'symbol' => 'TT$',
            ],
            [
                'name' => 'Lira',
                'code' => 'TRY',
                'symbol' => '₺',
            ],
            [
                'name' => 'Liras',
                'code' => 'TRL',
                'symbol' => '£',
            ],
            [
                'name' => 'Dollars',
                'code' => 'TVD',
                'symbol' => '$',
            ],
            [
                'name' => 'Hryvnia',
                'code' => 'UAH',
                'symbol' => '₴',
            ],
            [
                'name' => 'Pesos',
                'code' => 'UYU',
                'symbol' => '$U',
            ],
            [
                'name' => 'Sums',
                'code' => 'UZS',
                'symbol' => 'лв',
            ],
            [
                'name' => 'Bolivares Fuertes',
                'code' => 'VEF',
                'symbol' => 'Bs',
            ],
            [
                'name' => 'Dong',
                'code' => 'VND',
                'symbol' => '₫',
            ],
            [
                'name' => 'Rials',
                'code' => 'YER',
                'symbol' => '﷼',
            ],
            [
                'name' => 'Zimbabwe Dollars',
                'code' => 'ZWD',
                'symbol' => 'Z$',
            ],
            [
                'name' => 'Rupees',
                'code' => 'INR',
                'symbol' => '₹',
            ],
            [
                'name' => 'Algerian Dinar',
                'code' => 'DZD',
                'symbol' => 'DA',
            ],
            [
                'name' => 'Kwanza',
                'code' => 'AOA',
                'symbol' => 'Kz',
            ],
            [
                'name' => 'Antarctic Dollar',
                'code' => 'AAD',
                'symbol' => '$',
            ],
            [
                'name' => 'Armenian Dram',
                'code' => 'AMD',
                'symbol' => '֏',
            ],
            [
                'name' => 'Bahraini Dinar',
                'code' => 'BHD',
                'symbol' => 'BD',
            ],
            [
                'name' => 'Bangladeshi Taka',
                'code' => 'BDT',
                'symbol' => '৳',
            ]
        ];

        DB::table('currencies')->insert($currencies);

        $update = [
            'created_at' => now(),
            'updated_at' => now()
        ];

        DB::table('currencies')->update($update);
    }
}
