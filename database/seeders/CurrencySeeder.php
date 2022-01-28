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
                'name' => '(ALL) Leke',
                'code' => 'ALL',
                'symbol' => 'Lek',
            ],
            [
                'name' => '(USD) Dollars',
                'code' => 'USD',
                'symbol' => '$',
            ],
            [
                'name' => '(AFN) Afghanis',
                'code' => 'AFN',
                'symbol' => '؋',
            ],
            [
                'name' => '(ARS) Pesos',
                'code' => 'ARS',
                'symbol' => '$',
            ],
            [
                'name' => '(AWG) Guilders',
                'code' => 'AWG',
                'symbol' => 'ƒ',
            ],
            [
                'name' => '(AUD) Dollars',
                'code' => 'AUD',
                'symbol' => '$',
            ],
            [
                'name' => '(AZN) New Manats',
                'code' => 'AZN',
                'symbol' => 'ман',
            ],
            [
                'name' => '(BSD) Dollars',
                'code' => 'BSD',
                'symbol' => '$',
            ],
            [
                'name' => '(BBD) Dollars',
                'code' => 'BBD',
                'symbol' => '$',
            ],
            [
                'name' => '(BYR) Rubles',
                'code' => 'BYR',
                'symbol' => 'p.',
            ],
            [
                'name' => '(EUR) Euro',
                'code' => 'EUR',
                'symbol' => '€',
            ],
            [
                'name' => '(BZD) Dollars',
                'code' => 'BZD',
                'symbol' => 'BZ$',
            ],
            [
                'name' => '(BMD) Dollars',
                'code' => 'BMD',
                'symbol' => '$',
            ],
            [
                'name' => '(BOB) Bolivianos',
                'code' => 'BOB',
                'symbol' => '$b',
            ],
            [
                'name' => '(BAM) Convertible Marka',
                'code' => 'BAM',
                'symbol' => 'KM',
            ],
            [
                'name' => '(BWP) Pula',
                'code' => 'BWP',
                'symbol' => 'P',
            ],
            [
                'name' => '(BGN) Leva',
                'code' => 'BGN',
                'symbol' => 'лв',
            ],
            [
                'name' => '(BRL) Reais',
                'code' => 'BRL',
                'symbol' => 'R$',
            ],
            [
                'name' => '(GBP) Pounds',
                'code' => 'GBP',
                'symbol' => '£',
            ],
            [
                'name' => '(BND) Dollars',
                'code' => 'BND',
                'symbol' => '$',
            ],
            [
                'name' => '(KHR) Riels',
                'code' => 'KHR',
                'symbol' => '៛',
            ],
            [
                'name' => '(CAD) Dollars',
                'code' => 'CAD',
                'symbol' => '$',
            ],
            [
                'name' => '(KYD) Dollars',
                'code' => 'KYD',
                'symbol' => '$',
            ],
            [
                'name' => '(CLP) Pesos',
                'code' => 'CLP',
                'symbol' => '$',
            ],
            [
                'name' => '(CNY) Yuan Renminbi',
                'code' => 'CNY',
                'symbol' => '¥',
            ],
            [
                'name' => '(COP) Pesos',
                'code' => 'COP',
                'symbol' => '$',
            ],
            [
                'name' => '(CRC) Colón',
                'code' => 'CRC',
                'symbol' => '₡',
            ],
            [
                'name' => '(HRK) Kuna',
                'code' => 'HRK',
                'symbol' => 'kn',
            ],
            [
                'name' => '(CUP) Pesos',
                'code' => 'CUP',
                'symbol' => '₱',
            ],
            [
                'name' => '(CZK) Koruny',
                'code' => 'CZK',
                'symbol' => 'Kč',
            ],
            [
                'name' => '(DKK) Kroner',
                'code' => 'DKK',
                'symbol' => 'kr',
            ],
            [
                'name' => '(DOP) Pesos',
                'code' => 'DOP',
                'symbol' => 'RD$',
            ],
            [
                'name' => '(XCD) Dollars',
                'code' => 'XCD',
                'symbol' => '$',
            ],
            [
                'name' => '(EGP) Pounds',
                'code' => 'EGP',
                'symbol' => '£',
            ],
            [
                'name' => '(SVC) Colones',
                'code' => 'SVC',
                'symbol' => '$',
            ],
            [
                'name' => '(FKP) Pounds',
                'code' => 'FKP',
                'symbol' => '£',
            ],
            [
                'name' => '(FJD) Dollars',
                'code' => 'FJD',
                'symbol' => '$',
            ],
            [
                'name' => '(GHC) Cedis',
                'code' => 'GHC',
                'symbol' => '¢',
            ],
            [
                'name' => '(GIP) Pounds',
                'code' => 'GIP',
                'symbol' => '£',
            ],
            [
                'name' => '(GTQ) Quetzales',
                'code' => 'GTQ',
                'symbol' => 'Q',
            ],
            [
                'name' => '(GGP) Pounds',
                'code' => 'GGP',
                'symbol' => '£',
            ],
            [
                'name' => '(GYD) Dollars',
                'code' => 'GYD',
                'symbol' => '$',
            ],
            [
                'name' => '(HNL) Lempiras',
                'code' => 'HNL',
                'symbol' => 'L',
            ],
            [
                'name' => '(HKD) Dollars',
                'code' => 'HKD',
                'symbol' => '$',
            ],
            [
                'name' => '(HUF) Forint',
                'code' => 'HUF',
                'symbol' => 'Ft',
            ],
            [
                'name' => '(ISK) Kronur',
                'code' => 'ISK',
                'symbol' => 'kr',
            ],
            [
                'name' => '(INR) Rupees',
                'code' => 'INR',
                'symbol' => 'Rp',
            ],
            [
                'name' => '(IDR) Rupiahs',
                'code' => 'IDR',
                'symbol' => 'Rp',
            ],
            [
                'name' => '(IRR) Rials',
                'code' => 'IRR',
                'symbol' => '﷼',
            ],
            [
                'name' => '(IMP) Pounds',
                'code' => 'IMP',
                'symbol' => '£',
            ],
            [
                'name' => '(ILS) New Shekels',
                'code' => 'ILS',
                'symbol' => '₪',
            ],
            [
                'name' => '(JMD) Dollars',
                'code' => 'JMD',
                'symbol' => 'J$',
            ],
            [
                'name' => '(JPY) Yen',
                'code' => 'JPY',
                'symbol' => '¥',
            ],
            [
                'name' => '(JEP) Pounds',
                'code' => 'JEP',
                'symbol' => '£',
            ],
            [
                'name' => '(KZT) Tenge',
                'code' => 'KZT',
                'symbol' => 'лв',
            ],
            [
                'name' => '(KPW) Won',
                'code' => 'KPW',
                'symbol' => '₩',
            ],
            [
                'name' => '(KRW) Won',
                'code' => 'KRW',
                'symbol' => '₩',
            ],
            [
                'name' => '(KGS) Soms',
                'code' => 'KGS',
                'symbol' => 'лв',
            ],
            [
                'name' => '(LAK) Kips',
                'code' => 'LAK',
                'symbol' => '₭',
            ],
            [
                'name' => '(LVL) Lati',
                'code' => 'LVL',
                'symbol' => 'Ls',
            ],
            [
                'name' => '(LBP) Pounds',
                'code' => 'LBP',
                'symbol' => '£',
            ],
            [
                'name' => '(LRD) Dollars',
                'code' => 'LRD',
                'symbol' => '$',
            ],
            [
                'name' => '(CHF) Switzerland Francs',
                'code' => 'CHF',
                'symbol' => 'CHF',
            ],
            [
                'name' => '(LTL) Litai',
                'code' => 'LTL',
                'symbol' => 'Lt',
            ],
            [
                'name' => '(MKD) Denars',
                'code' => 'MKD',
                'symbol' => 'ден',
            ],
            [
                'name' => '(MYR) Ringgits',
                'code' => 'MYR',
                'symbol' => 'RM',
            ],
            [
                'name' => '(MUR) Rupees',
                'code' => 'MUR',
                'symbol' => '₨',
            ],
            [
                'name' => '(MXN) Pesos',
                'code' => 'MXN',
                'symbol' => '$',
            ],
            [
                'name' => '(MNT) Tugriks',
                'code' => 'MNT',
                'symbol' => '₮',
            ],
            [
                'name' => '(MZN) Meticais',
                'code' => 'MZN',
                'symbol' => 'MT',
            ],
            [
                'name' => '(NAD) Dollars',
                'code' => 'NAD',
                'symbol' => '$',
            ],
            [
                'name' => '(NPR) Rupees',
                'code' => 'NPR',
                'symbol' => '₨',
            ],
            [
                'name' => '(ANG) Guilders',
                'code' => 'ANG',
                'symbol' => 'ƒ',
            ],
            [
                'name' => '(NZD) Dollars',
                'code' => 'NZD',
                'symbol' => '$',
            ],
            [
                'name' => '(NIO) Cordobas',
                'code' => 'NIO',
                'symbol' => 'C$',
            ],
            [
                'name' => '(NGN) Nairas',
                'code' => 'NGN',
                'symbol' => '₦',
            ],
            [
                'name' => '(NOK) Krone',
                'code' => 'NOK',
                'symbol' => 'kr',
            ],
            [
                'name' => '(OMR) Rials',
                'code' => 'OMR',
                'symbol' => '﷼',
            ],
            [
                'name' => '(PKR) Rupees',
                'code' => 'PKR',
                'symbol' => '₨',
            ],
            [
                'name' => '(PAB) Balboa',
                'code' => 'PAB',
                'symbol' => 'B/.',
            ],
            [
                'name' => '(PYG) Guarani',
                'code' => 'PYG',
                'symbol' => 'Gs',
            ],
            [
                'name' => '(PEN) Nuevos Soles',
                'code' => 'PEN',
                'symbol' => 'S/.',
            ],
            [
                'name' => '(PHP) Pesos',
                'code' => 'PHP',
                'symbol' => 'Php',
            ],
            [
                'name' => '(PLN) Zlotych',
                'code' => 'PLN',
                'symbol' => 'zł',
            ],
            [
                'name' => '(QAR) Rials',
                'code' => 'QAR',
                'symbol' => '﷼',
            ],
            [
                'name' => '(RON) New Lei',
                'code' => 'RON',
                'symbol' => 'lei',
            ],
            [
                'name' => '(RUB) Rubles',
                'code' => 'RUB',
                'symbol' => 'руб',
            ],
            [
                'name' => '(SHP) Pounds',
                'code' => 'SHP',
                'symbol' => '£',
            ],
            [
                'name' => '(SAR) Riyals',
                'code' => 'SAR',
                'symbol' => '﷼',
            ],
            [
                'name' => '(RSD) Dinars',
                'code' => 'RSD',
                'symbol' => 'Дин.',
            ],
            [
                'name' => '(SCR) Rupees',
                'code' => 'SCR',
                'symbol' => '₨',
            ],
            [
                'name' => '(SGD) Dollars',
                'code' => 'SGD',
                'symbol' => '$',
            ],
            [
                'name' => '(SBD) Dollars',
                'code' => 'SBD',
                'symbol' => '$',
            ],
            [
                'name' => '(SOS) Shillings',
                'code' => 'SOS',
                'symbol' => 'S',
            ],
            [
                'name' => '(ZAR) Rand',
                'code' => 'ZAR',
                'symbol' => 'R',
            ],
            [
                'name' => '(LKR) Rupees',
                'code' => 'LKR',
                'symbol' => '₨',
            ],
            [
                'name' => '(SEK) Kronor',
                'code' => 'SEK',
                'symbol' => 'kr',
            ],
            [
                'name' => '(SRD) Dollars',
                'code' => 'SRD',
                'symbol' => '$',
            ],
            [
                'name' => '(SYP) Pounds',
                'code' => 'SYP',
                'symbol' => '£',
            ],
            [
                'name' => '(TWD) New Dollars',
                'code' => 'TWD',
                'symbol' => 'NT$',
            ],
            [
                'name' => '(THB) Baht',
                'code' => 'THB',
                'symbol' => '฿',
            ],
            [
                'name' => '(TTD) Dollars',
                'code' => 'TTD',
                'symbol' => 'TT$',
            ],
            [
                'name' => '(TRY) Lira',
                'code' => 'TRY',
                'symbol' => '₺',
            ],
            [
                'name' => '(TRL) Liras',
                'code' => 'TRL',
                'symbol' => '£',
            ],
            [
                'name' => '(TVD) Dollars',
                'code' => 'TVD',
                'symbol' => '$',
            ],
            [
                'name' => '(UAH) Hryvnia',
                'code' => 'UAH',
                'symbol' => '₴',
            ],
            [
                'name' => '(UYU) Pesos',
                'code' => 'UYU',
                'symbol' => '$U',
            ],
            [
                'name' => '(UZS) Sums',
                'code' => 'UZS',
                'symbol' => 'лв',
            ],
            [
                'name' => '(VEF) Bolivares Fuertes',
                'code' => 'VEF',
                'symbol' => 'Bs',
            ],
            [
                'name' => '(VND) Dong',
                'code' => 'VND',
                'symbol' => '₫',
            ],
            [
                'name' => '(YER) Rials',
                'code' => 'YER',
                'symbol' => '﷼',
            ],
            [
                'name' => '(ZWD) Zimbabwe Dollars',
                'code' => 'ZWD',
                'symbol' => 'Z$',
            ],
            [
                'name' => '(INR) Rupees',
                'code' => 'INR',
                'symbol' => '₹',
            ],
            [
                'name' => '(DZD) Algerian Dinar',
                'code' => 'DZD',
                'symbol' => 'DA',
            ],
            [
                'name' => '(AOA) Kwanza',
                'code' => 'AOA',
                'symbol' => 'Kz',
            ],
            [
                'name' => '(AAD) Antarctic Dollar',
                'code' => 'AAD',
                'symbol' => '$',
            ],
            [
                'name' => '(AMD) Armenian Dram',
                'code' => 'AMD',
                'symbol' => '֏',
            ],
            [
                'name' => '(BHD) Bahraini Dinar',
                'code' => 'BHD',
                'symbol' => 'BD',
            ],
            [
                'name' => '(BDT) Bangladeshi Taka',
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
