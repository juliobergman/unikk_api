<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PeccSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {


        $peccs = [
            [
                'company_id' => 1,
                'user_id' => 1,
                'name' => 'Blackstone',
                'type' => 'Private equity',
                'region' => 'US fond in Europe',
                'based' => 'US',
                'main_countries' => 'Germany',
                'main_cities' => 'Frankfurt',
                'sector' => 'Life Sciences, Infrastructure, Tactical Opportunities, Seeding',
                'geo_focus' => 'Global',
            ],

            [
                'company_id' => 1,
                'user_id' => 1,
                'name' => 'Advent International',
                'type' => 'Private equity',
                'region' => 'US fond in Europe',
                'based' => 'US',
                'main_countries' => 'Germany, Italy',
                'main_cities' => 'Frankfurt , Milan',
                'sector' => 'Business & Financial Services, Healthcare, Industrial, Retail, consumer & Leisure, Technology',
                'geo_focus' => 'North America, Europe and selected Emergin markets Latin America',
            ],

            [
                'company_id' => 1,
                'user_id' => 1,
                'name' => 'Carlyle Group',
                'type' => 'Private equity',
                'region' => 'US fond in Europe',
                'based' => 'US',
                'main_countries' => 'Germany,The netherlands,Italy, France, Spain',
                'main_cities' => 'Munich, Amsterdan, Milan, Paris, Barcelona',
                'sector' => 'Aerospace, defense, consumer, media retail, financial services, healthcare, industrial & Transportation, Tech Energy',
                'geo_focus' => 'Global',
            ],

            [
                'company_id' => 1,
                'user_id' => 1,
                'name' => 'KKR',
                'type' => 'Private equity',
                'region' => 'US fond in Europe',
                'based' => 'US',
                'main_countries' => 'Germany, Luxembug, France',
                'main_cities' => 'Frankfurt, Luxemburg, Paris',
                'sector' => 'All',
                'geo_focus' => 'Global',
            ],

            [
                'company_id' => 1,
                'user_id' => 1,
                'name' => 'Bain Capital',
                'type' => 'Private equity , VC',
                'region' => 'US fond in Europe',
                'based' => 'US',
                'main_countries' => 'Germany, Luxemburg',
                'main_cities' => 'Munich, Luxemburg',
                'sector' => 'Prop tech, Comerce technology, Saas Data service, Fintech, Infrestructure software, Healthcare, Consumer, Financial services',
                'geo_focus' => 'Americas, Asia-Pacific, Europe',
            ],

            [
                'company_id' => 1,
                'user_id' => 1,
                'name' => 'EQT Partners',
                'type' => 'Private equity , VC',
                'region' => 'Nordic ',
                'based' => 'SE',
                'main_countries' => 'Sweden,Germany, Swizterland, UK',
                'main_cities' => 'Stokcholm, Berlin, Munich, Zurich, London',
                'sector' => 'TMT, Healthcare, services, consumer, Industrial Technology',
                'geo_focus' => 'Europe, Asia- Americas',
            ],

            [
                'company_id' => 1,
                'user_id' => 1,
                'name' => 'Nordic Capital',
                'type' => 'Private Equity',
                'region' => 'Nordic ',
                'based' => 'SE',
                'main_countries' => 'Sweden,Germany,UK',
                'main_cities' => 'Stockholm, Frankfurt, London',
                'sector' => 'Health Care, tech and payments, Financial services, industrial and business services, Consumer',
                'geo_focus' => 'Europe & China',
            ],

            [
                'company_id' => 1,
                'user_id' => 1,
                'name' => 'IK Invesments partners',
                'type' => 'Private Equity',
                'region' => 'Nordic',
                'based' => 'GB',
                'main_countries' => 'Uk, Germany, Netherlands',
                'main_cities' => 'London, Hamburg, Amsterdan',
                'sector' => 'Consumer goods, foods, healthcare ,Enginereed products, Services',
                'geo_focus' => 'Europe',
            ],

            [
                'company_id' => 1,
                'user_id' => 1,
                'name' => 'Altor equity Partners',
                'type' => 'Private Equity',
                'region' => 'Nordic ',
                'based' => 'SE',
                'main_countries' => 'Sweden, denmark, Finland',
                'main_cities' => 'Stockholm, Copenhague, Helsinski',
                'sector' => 'Business services wholesale, Consumer  retail, Energy, Tech, Financial Serivces, public sector, Industrial',
                'geo_focus' => 'Europe',
            ],

            [
                'company_id' => 1,
                'user_id' => 1,
                'name' => 'Hictectvision',
                'type' => 'Private Equity',
                'region' => 'Nordic ',
                'based' => 'NO',
                'main_countries' => 'Norway',
                'main_cities' => 'Oslo',
                'sector' => 'Infrastructure, Exploration and production, Oil, Property, Drilling, Financial serivces , Subsea services, Energy',
                'geo_focus' => 'Europe & Asia',
            ],
            // 10
            [
                'company_id' => 1,
                'user_id' => 1,
                'name' => 'Permira',
                'type' => 'Private Equity',
                'region' => 'UK',
                'based' => 'GB',
                'main_countries' => 'Uk, Germany, Guernsey',
                'main_cities' => 'London, Frankfurt, Guernsey',
                'sector' => 'Consumer, Healthcare, Services, Technology',
                'geo_focus' => 'Europe & APAC',
            ],

            [
                'company_id' => 1,
                'user_id' => 1,
                'name' => 'Cinven',
                'type' => 'Private equity',
                'region' => 'UK',
                'based' => 'GB',
                'main_countries' => 'UK, Germany, Italy',
                'main_cities' => 'London, Frankfurt, Milan',
                'sector' => 'Business services,  Consumer , Financial Services, TMT, Healthcare, Indutrial',
                'geo_focus' => 'Europe & Americas',
            ],

            [
                'company_id' => 1,
                'user_id' => 1,
                'name' => 'Apax Partners',
                'type' => 'Private equity, VC',
                'region' => 'UK',
                'based' => 'GB',
                'main_countries' => 'UK, Gernany, Israel',
                'main_cities' => 'London, Munich, Tel Aviv',
                'sector' => 'Tech, Serivices, Healthcare , Internet, Cosunmer',
                'geo_focus' => 'Europe, Asia, Americas',
            ],

            [
                'company_id' => 1,
                'user_id' => 1,
                'name' => 'BC Partners',
                'type' => 'Private equity, VC',
                'region' => 'UK',
                'based' => 'GB',
                'main_countries' => 'UK, Germany',
                'main_cities' => 'London,  Hamburg',
                'sector' => 'Business services,  Consumer , Financial Services, TMT, Healthcare, Indutrial, retail',
                'geo_focus' => 'Europe & Americas',
            ],

            [
                'company_id' => 1,
                'user_id' => 1,
                'name' => 'Bridgepoint',
                'type' => 'Private equity, VC',
                'region' => 'UK',
                'based' => 'GB',
                'main_countries' => 'UK, Germany, Netherlands',
                'main_cities' => 'London, Frankfurt, Amsterdam',
                'sector' => 'Business Services, Consumer, Financial Services, Healthcare, MedTech & Pharma, Manufacturing & Industrials and Digital, Technology & Media',
                'geo_focus' => 'Europe, USA & China',
            ],

            [
                'company_id' => 1,
                'user_id' => 1,
                'name' => 'CVC Capital',
                'type' => 'Private equity, VC',
                'region' => 'France+ Benelux',
                'based' => 'LU',
                'main_countries' => 'Luxemburg, Germany, UK',
                'main_cities' => 'Luxemburg, Frankfurt, London',
                'sector' => 'Chemicals, Business services, Building, Energy, Financial Services, Media, tech, telecoms, healthcare',
                'geo_focus' => 'Europe, Asia, Americas',
            ],

            [
                'company_id' => 1,
                'user_id' => 1,
                'name' => 'Ardian',
                'type' => 'Private equity, VC',
                'region' => 'France+ Benelux',
                'based' => 'FR',
                'main_countries' => 'France, Uk, Germany , Spain',
                'main_cities' => 'Paris, London Frankfurt, Madrid',
                'sector' => 'Helthcare life science, E-Commerce, Internet Software service, Tech, media and telecom, Software business services',
                'geo_focus' => 'Europe',
            ],

            [
                'company_id' => 1,
                'user_id' => 1,
                'name' => 'PAI partners',
                'type' => 'Private equity, VC',
                'region' => 'France+ Benelux',
                'based' => 'FR',
                'main_countries' => 'France , UK , Germany, Spain',
                'main_cities' => 'Paris, London Frankfurt, Madrid',
                'sector' => 'Business Serivices & Distribution, Food consumer, General industrials, Healthcare',
                'geo_focus' => 'Europe and USA',
            ],

            [
                'company_id' => 1,
                'user_id' => 1,
                'name' => 'Astorg',
                'type' => 'Private equity, VC',
                'region' => 'France+ Benelux',
                'based' => 'FR',
                'main_countries' => 'France, Uk, Germany , Italy',
                'main_cities' => 'Paris, London Frankfurt, Milan',
                'sector' => 'Healthcare, B2B Services, Software, TMT, Aerospace, mediatelecom, Chemicals, Manufacturing',
                'geo_focus' => 'Europe & USA',
            ],

            [
                'company_id' => 1,
                'user_id' => 1,
                'name' => 'Equistone',
                'type' => 'Private Equity ',
                'region' => 'France+ Benelux',
                'based' => 'FR',
                'main_countries' => 'France, UK, Germany, Switzerland',
                'main_cities' => 'Paris, London, Munich, Zurich',
                'sector' => 'ALL',
                'geo_focus' => 'Europe ',
            ],

            // 20
            [
                'company_id' => 1,
                'user_id' => 1,
                'name' => 'Triton',
                'type' => 'Private equity',
                'region' => 'DACH',
                'based' => 'DE',
                'main_countries' => 'Germany,Uk , Italy',
                'main_cities' => 'Frankfurt, London, Milan',
                'sector' => 'Businnes services, Industrial,  Consumer, Health',
                'geo_focus' => 'Europe & USA',
            ],

            [
                'company_id' => 1,
                'user_id' => 1,
                'name' => 'Partners Group',
                'type' => 'Private equtiy',
                'region' => 'DACH',
                'based' => 'CH',
                'main_countries' => 'Switzerland,Germany, France, Luxemburg',
                'main_cities' => 'Zug, Munich, Paris, Luxemburg',
                'sector' => 'Healthcare, consumer, Media & telecom, Information technology, Industrials, infrastructure, energy, Financial services, Real state',
                'geo_focus' => 'Americas, Asia-Pacific, Europe',
            ],

            [
                'company_id' => 1,
                'user_id' => 1,
                'name' => 'Capvis',
                'type' => 'Private equity',
                'region' => 'DACH',
                'based' => 'CH',
                'main_countries' => 'Switzerland ',
                'main_cities' => 'Baar',
                'sector' => 'Healthcare, Industrial technology, Advanced services & Softwares',
                'geo_focus' => 'Europe',
            ],

            [
                'company_id' => 1,
                'user_id' => 1,
                'name' => 'DBAG',
                'type' => 'Private equity, VC',
                'region' => 'DACH',
                'based' => 'DE',
                'main_countries' => 'Germany',
                'main_cities' => 'Frankfurt',
                'sector' => 'Industrial Services, mechanical and engineering, industrial components, industrial components.',
                'geo_focus' => 'Europe Mostly Germany',
            ],

            [
                'company_id' => 1,
                'user_id' => 1,
                'name' => 'CASTIK Capital Partners',
                'type' => 'Private equity, VC',
                'region' => 'DACH',
                'based' => 'DE',
                'main_countries' => 'Germany',
                'main_cities' => 'Munich',
                'sector' => 'Precision Manufacturing, IOT solutions, Healthcare, Software, business services',
                'geo_focus' => 'Europe',
            ],

            [
                'company_id' => 1,
                'user_id' => 1,
                'name' => 'Investindustrial',
                'type' => 'Private equity, VC',
                'region' => 'South Europeans Funds',
                'based' => 'ES',
                'main_countries' => 'Spain, Switzerland',
                'main_cities' => 'Madrid, Lugano',
                'sector' => 'Healtchare consumer and leisure, industrial Manufacturing, Technology',
                'geo_focus' => 'Europe',
            ],

            [
                'company_id' => 1,
                'user_id' => 1,
                'name' => 'F2i',
                'type' => 'Private equity, VC',
                'region' => 'South Europeans Funds',
                'based' => 'IT',
                'main_countries' => 'Italy',
                'main_cities' => 'Milan',
                'sector' => 'All',
                'geo_focus' => 'Europe Mostly Italy',
            ],

            [
                'company_id' => 1,
                'user_id' => 1,
                'name' => 'FSI',
                'type' => 'Private equity, VC',
                'region' => 'South Europeans Funds',
                'based' => 'IT',
                'main_countries' => 'italy',
                'main_cities' => 'Milan',
                'sector' => 'Fintech, engineering, fashion, biopharmaceutical',
                'geo_focus' => 'Europe',
            ],

            [
                'company_id' => 1,
                'user_id' => 1,
                'name' => 'NB renaissance partners',
                'type' => 'Private equity, VC',
                'region' => 'South Europeans Funds',
                'based' => 'IT',
                'main_countries' => 'Italy, Uk, Zurich',
                'main_cities' => 'Milan, london, Zurich',
                'sector' => 'All',
                'geo_focus' => 'Global',
            ],

            [
                'company_id' => 1,
                'user_id' => 1,
                'name' => 'Alpha Group',
                'type' => 'Private equity, VC',
                'region' => 'South Europeans Funds',
                'based' => 'IT',
                'main_countries' => 'Italy, Germany, France',
                'main_cities' => 'Milan, Frankfurt, Paris',
                'sector' => 'industrial, consumer and leisure, fashion & design',
                'geo_focus' => 'Europe',
            ],

            // 30
            [
                'company_id' => 1,
                'user_id' => 1,
                'name' => 'MBK Partners',
                'type' => 'Private Equity',
                'region' => 'Asia',
                'based' => 'KR',
                'main_countries' => 'South Korea',
                'main_cities' => 'Seoul',
                'sector' => 'All',
                'geo_focus' => 'North Asia',
            ],

            [
                'company_id' => 1,
                'user_id' => 1,
                'name' => 'Affinity equity Partners',
                'type' => 'Private Equity',
                'region' => 'Asia',
                'based' => 'HK',
                'main_countries' => 'Hong kong, Singapore, Korea, Australia',
                'main_cities' => 'Hong kong, Singapore, Seoul, Sidney',
                'sector' => 'consumer-related goods and services, food and beverage, healthcare and pharmaceutical, financial services, telecom and media, environmental businesses, agriculture and natural resources. We do not invest in companies whose principal business activities are real estate, biotechnology, tobacco, oil and gas exploration, and weaponry development and sales.',
                'geo_focus' => 'APAC',
            ],

            [
                'company_id' => 1,
                'user_id' => 1,
                'name' => 'RRj Capital',
                'type' => 'Private Equity',
                'region' => 'Asia',
                'based' => 'HK',
                'main_countries' => 'Hong kong, Singapore',
                'main_cities' => 'Hong kong, Singapore',
                'sector' => 'healthcare, financial institutions, technology, and logistics.',
                'geo_focus' => 'APAC, Europe, USA',
            ],

            [
                'company_id' => 1,
                'user_id' => 1,
                'name' => 'Baring Private equity Asia',
                'type' => 'Private Equity',
                'region' => 'Asia',
                'based' => 'HK',
                'main_countries' => 'Hong kong, China, India',
                'main_cities' => 'Hong Kong, Beijing, Mumbai',
                'sector' => 'All',
                'geo_focus' => 'APAC',
            ],

            [
                'company_id' => 1,
                'user_id' => 1,
                'name' => 'CITIC PE',
                'type' => 'Private Equity',
                'region' => 'Asia',
                'based' => 'CN',
                'main_countries' => 'China, Hong kong',
                'main_cities' => 'Beijing,  Hong Kong',
                'sector' => 'healthcare, Consumer and internet, Technology and industrial , Software',
                'geo_focus' => 'APAC',
            ],

            [
                'company_id' => 1,
                'user_id' => 1,
                'name' => 'CDH Investments',
                'type' => 'Private Equity , VC',
                'region' => 'Asia',
                'based' => 'CN',
                'main_countries' => 'China, Hong kong',
                'main_cities' => 'Beijing,  Hong Kong',
                'sector' => 'Retail, consumer goods, industrial Energy, Financial services, TMT, Automotiles, Logistic',
                'geo_focus' => 'Asia Mostly china',
            ],

            [
                'company_id' => 1,
                'user_id' => 1,
                'name' => 'CITIC Capital',
                'type' => 'Private Equity',
                'region' => 'Asia',
                'based' => 'CN',
                'main_countries' => 'China , Japan',
                'main_cities' => 'Tokyo , Beijing',
                'sector' => 'All',
                'geo_focus' => 'APAC',
            ],

            [
                'company_id' => 1,
                'user_id' => 1,
                'name' => 'PAG',
                'type' => 'Private Equity',
                'region' => 'Asia',
                'based' => 'JP',
                'main_countries' => 'Japan, Singapore, South korea, Australia, Switzerland',
                'main_cities' => 'Tokyo, Singapore, Seoul, Sidney, Geneva',
                'sector' => 'Business and product services, Consumers, tech, financials services, media & enterteiment',
                'geo_focus' => 'Americas, Asia-Pacific, Europe',
            ],

            [
                'company_id' => 1,
                'user_id' => 1,
                'name' => 'Hopu Investments Management',
                'type' => 'Private Equity, VC',
                'region' => 'Asia',
                'based' => 'CN',
                'main_countries' => 'China',
                'main_cities' => 'Beijing ',
                'sector' => 'NI',
                'geo_focus' => 'Asia ',
            ],

            [
                'company_id' => 1,
                'user_id' => 1,
                'name' => 'Hony Capital',
                'type' => 'Private Equity',
                'region' => 'Asia',
                'based' => 'CN',
                'main_countries' => 'China, Hong kong',
                'main_cities' => 'Beijing,  Hong Kong',
                'sector' => 'pharmaceutical and healthcare, consumer products, catering, media and entertainment, environmental protection and new energy',
                'geo_focus' => 'Global',
            ],
            //40
            [
                'company_id' => 1,
                'user_id' => 1,
                'name' => 'Ince Capital Partners',
                'type' => 'Private Equity',
                'region' => 'Asia',
                'based' => 'CN',
                'main_countries' => 'China, Hong kong',
                'main_cities' => 'Beijing,  Hong Kong',
                'sector' => 'Internet consumer and intelligent technologies',
                'geo_focus' => 'China',
            ],

            [
                'company_id' => 1,
                'user_id' => 1,
                'name' => 'Mercury Capital',
                'type' => 'Private Equity, Direct placement',
                'region' => 'Asia',
                'based' => 'JP',
                'main_countries' => 'Japan, Singapore, India',
                'main_cities' => 'Tokyo, Singapore, New Dehli',
                'sector' => 'NI',
                'geo_focus' => 'Global',
            ],

            [
                'company_id' => 1,
                'user_id' => 1,
                'name' => 'Olympus Capital',
                'type' => 'Private Equity, VC',
                'region' => 'Asia',
                'based' => 'CN',
                'main_countries' => 'China, India',
                'main_cities' => 'Shangai, Delhi',
                'sector' => 'including financial services, environmental services, business services, healthcare and renewable energy,',
                'geo_focus' => 'Asia',
            ],

            [
                'company_id' => 1,
                'user_id' => 1,
                'name' => 'Tiger Global Management',
                'type' => 'Private Equity, VC',
                'region' => 'Asia',
                'based' => 'CN',
                'main_countries' => 'China/ Usa',
                'main_cities' => 'New york',
                'sector' => 'Internet, technology, telecom, media consumer, and industrial',
                'geo_focus' => 'Global',
            ]
        ];

        DB::table('peccs')->insert($peccs);

        $update = [
            'created_at' => now(),
            'updated_at' => now()
        ];

        DB::table('peccs')->update($update);

    }
}
