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
                'fund' => 'Blackstone',
                'type' => 'Private equity',
                'region' => 'US fond in Europe',
                'based' => 'us',
                'main_countries' => 'Germany',
                'main_cities' => 'Frankfurt',
                'sector' => 'Life Sciences, Infrastructure, Tactical Opportunities, Seeding',
                'geo_focus' => 'Global',
            ],

            [
                'company_id' => 1,
                'user_id' => 1,
                'fund' => 'Advent International',
                'type' => 'Private equity',
                'region' => 'US fond in Europe',
                'based' => 'us',
                'main_countries' => 'Germany, Italy',
                'main_cities' => 'Frankfurt , Milan',
                'sector' => 'Business & Financial Services, Healthcare, Industrial, Retail, consumer & Leisure, Technology',
                'geo_focus' => 'North America, Europe and selected Emergin markets Latin America',
            ],

            [
                'company_id' => 1,
                'user_id' => 1,
                'fund' => 'Carlyle Group',
                'type' => 'Private equity',
                'region' => 'US fond in Europe',
                'based' => 'us',
                'main_countries' => 'Germany,The netherlands,Italy, France, Spain',
                'main_cities' => 'Munich, Amsterdan, Milan, Paris, Barcelona',
                'sector' => 'Aerospace, defense, consumer, media retail, financial services, healthcare, industrial & Transportation, Tech Energy',
                'geo_focus' => 'Global',
            ],

            [
                'company_id' => 1,
                'user_id' => 1,
                'fund' => 'KKR',
                'type' => 'Private equity',
                'region' => 'US fond in Europe',
                'based' => 'us',
                'main_countries' => 'Germany, Luxembug, France',
                'main_cities' => 'Frankfurt, Luxemburg, Paris',
                'sector' => 'All',
                'geo_focus' => 'Global',
            ],

            [
                'company_id' => 1,
                'user_id' => 1,
                'fund' => 'Bain Capital',
                'type' => 'Private equity , VC',
                'region' => 'US fond in Europe',
                'based' => 'us',
                'main_countries' => 'Germany, Luxemburg',
                'main_cities' => 'Munich, Luxemburg',
                'sector' => 'Prop tech, Comerce technology, Saas Data service, Fintech, Infrestructure software, Healthcare, Consumer, Financial services',
                'geo_focus' => 'Americas, Asia-Pacific, Europe',
            ],

            [
                'company_id' => 1,
                'user_id' => 1,
                'fund' => 'EQT Partners',
                'type' => 'Private equity , VC',
                'region' => 'Nordic ',
                'based' => 'se',
                'main_countries' => 'Sweden,Germany, Swizterland, UK',
                'main_cities' => 'Stokcholm, Berlin, Munich, Zurich, London',
                'sector' => 'TMT, Healthcare, services, consumer, Industrial Technology',
                'geo_focus' => 'Europe, Asia- Americas',
            ],

            [
                'company_id' => 1,
                'user_id' => 1,
                'fund' => 'Nordic Capital',
                'type' => 'Private Equity',
                'region' => 'Nordic ',
                'based' => 'se',
                'main_countries' => 'Sweden,Germany,UK',
                'main_cities' => 'Stockholm, Frankfurt, London',
                'sector' => 'Health Care, tech and payments, Financial services, industrial and business services, Consumer',
                'geo_focus' => 'Europe & China',
            ],

            [
                'company_id' => 1,
                'user_id' => 1,
                'fund' => 'IK Invesments partners',
                'type' => 'Private Equity',
                'region' => 'Nordic',
                'based' => 'gb',
                'main_countries' => 'Uk, Germany, Netherlands',
                'main_cities' => 'London, Hamburg, Amsterdan',
                'sector' => 'Consumer goods, foods, healthcare ,Enginereed products, Services',
                'geo_focus' => 'Europe',
            ],

            [
                'company_id' => 1,
                'user_id' => 1,
                'fund' => 'Altor equity Partners',
                'type' => 'Private Equity',
                'region' => 'Nordic ',
                'based' => 'se',
                'main_countries' => 'Sweden, denmark, Finland',
                'main_cities' => 'Stockholm, Copenhague, Helsinski',
                'sector' => 'Business services wholesale, Consumer  retail, Energy, Tech, Financial Serivces, public sector, Industrial',
                'geo_focus' => 'Europe',
            ],

            [
                'company_id' => 1,
                'user_id' => 1,
                'fund' => 'Hictectvision',
                'type' => 'Private Equity',
                'region' => 'Nordic ',
                'based' => 'no',
                'main_countries' => 'Norway',
                'main_cities' => 'Oslo',
                'sector' => 'Infrastructure, Exploration and production, Oil, Property, Drilling, Financial serivces , Subsea services, Energy',
                'geo_focus' => 'Europe & Asia',
            ],
            // 10
            [
                'company_id' => 1,
                'user_id' => 1,
                'fund' => 'Permira',
                'type' => 'Private Equity',
                'region' => 'UK',
                'based' => 'gb',
                'main_countries' => 'Uk, Germany, Guernsey',
                'main_cities' => 'London, Frankfurt, Guernsey',
                'sector' => 'Consumer, Healthcare, Services, Technology',
                'geo_focus' => 'Europe & APAC',
            ],

            [
                'company_id' => 1,
                'user_id' => 1,
                'fund' => 'Cinven',
                'type' => 'Private equity',
                'region' => 'UK',
                'based' => 'gb',
                'main_countries' => 'UK, Germany, Italy',
                'main_cities' => 'London, Frankfurt, Milan',
                'sector' => 'Business services,  Consumer , Financial Services, TMT, Healthcare, Indutrial',
                'geo_focus' => 'Europe & Americas',
            ],

            [
                'company_id' => 1,
                'user_id' => 1,
                'fund' => 'Apax Partners',
                'type' => 'Private equity, VC',
                'region' => 'UK',
                'based' => 'gb',
                'main_countries' => 'UK, Gernany, Israel',
                'main_cities' => 'London, Munich, Tel Aviv',
                'sector' => 'Tech, Serivices, Healthcare , Internet, Cosunmer',
                'geo_focus' => 'Europe, Asia, Americas',
            ],

            [
                'company_id' => 1,
                'user_id' => 1,
                'fund' => 'BC Partners',
                'type' => 'Private equity, VC',
                'region' => 'UK',
                'based' => 'gb',
                'main_countries' => 'UK, Germany',
                'main_cities' => 'London,  Hamburg',
                'sector' => 'Business services,  Consumer , Financial Services, TMT, Healthcare, Indutrial, retail',
                'geo_focus' => 'Europe & Americas',
            ],

            [
                'company_id' => 1,
                'user_id' => 1,
                'fund' => 'Bridgepoint',
                'type' => 'Private equity, VC',
                'region' => 'UK',
                'based' => 'gb',
                'main_countries' => 'UK, Germany, Netherlands',
                'main_cities' => 'London, Frankfurt, Amsterdam',
                'sector' => 'Business Services, Consumer, Financial Services, Healthcare, MedTech & Pharma, Manufacturing & Industrials and Digital, Technology & Media',
                'geo_focus' => 'Europe, USA & China',
            ],

            [
                'company_id' => 1,
                'user_id' => 1,
                'fund' => 'CVC Capital',
                'type' => 'Private equity, VC',
                'region' => 'France+ Benelux',
                'based' => 'lu',
                'main_countries' => 'Luxemburg, Germany, UK',
                'main_cities' => 'Luxemburg, Frankfurt, London',
                'sector' => 'Chemicals, Business services, Building, Energy, Financial Services, Media, tech, telecoms, healthcare',
                'geo_focus' => 'Europe, Asia, Americas',
            ],

            [
                'company_id' => 1,
                'user_id' => 1,
                'fund' => 'Ardian',
                'type' => 'Private equity, VC',
                'region' => 'France+ Benelux',
                'based' => 'fr',
                'main_countries' => 'France, Uk, Germany , Spain',
                'main_cities' => 'Paris, London Frankfurt, Madrid',
                'sector' => 'Helthcare life science, E-Commerce, Internet Software service, Tech, media and telecom, Software business services',
                'geo_focus' => 'Europe',
            ],

            [
                'company_id' => 1,
                'user_id' => 1,
                'fund' => 'PAI partners',
                'type' => 'Private equity, VC',
                'region' => 'France+ Benelux',
                'based' => 'fr',
                'main_countries' => 'France , UK , Germany, Spain',
                'main_cities' => 'Paris, London Frankfurt, Madrid',
                'sector' => 'Business Serivices & Distribution, Food consumer, General industrials, Healthcare',
                'geo_focus' => 'Europe and USA',
            ],

            [
                'company_id' => 1,
                'user_id' => 1,
                'fund' => 'Astorg',
                'type' => 'Private equity, VC',
                'region' => 'France+ Benelux',
                'based' => 'fr',
                'main_countries' => 'France, Uk, Germany , Italy',
                'main_cities' => 'Paris, London Frankfurt, Milan',
                'sector' => 'Healthcare, B2B Services, Software, TMT, Aerospace, mediatelecom, Chemicals, Manufacturing',
                'geo_focus' => 'Europe & USA',
            ],

            [
                'company_id' => 1,
                'user_id' => 1,
                'fund' => 'Equistone',
                'type' => 'Private Equity ',
                'region' => 'France+ Benelux',
                'based' => 'fr',
                'main_countries' => 'France, UK, Germany, Switzerland',
                'main_cities' => 'Paris, London, Munich, Zurich',
                'sector' => 'ALL',
                'geo_focus' => 'Europe ',
            ],

            // 20
            [
                'company_id' => 1,
                'user_id' => 1,
                'fund' => 'Triton',
                'type' => 'Private equity',
                'region' => 'DACH',
                'based' => 'de',
                'main_countries' => 'Germany,Uk , Italy',
                'main_cities' => 'Frankfurt, London, Milan',
                'sector' => 'Businnes services, Industrial,  Consumer, Health',
                'geo_focus' => 'Europe & USA',
            ],

            [
                'company_id' => 1,
                'user_id' => 1,
                'fund' => 'Partners Group',
                'type' => 'Private equtiy',
                'region' => 'DACH',
                'based' => 'ch',
                'main_countries' => 'Switzerland,Germany, France, Luxemburg',
                'main_cities' => 'Zug, Munich, Paris, Luxemburg',
                'sector' => 'Healthcare, consumer, Media & telecom, Information technology, Industrials, infrastructure, energy, Financial services, Real state',
                'geo_focus' => 'Americas, Asia-Pacific, Europe',
            ],

            [
                'company_id' => 1,
                'user_id' => 1,
                'fund' => 'Capvis',
                'type' => 'Private equity',
                'region' => 'DACH',
                'based' => 'ch',
                'main_countries' => 'Switzerland ',
                'main_cities' => 'Baar',
                'sector' => 'Healthcare, Industrial technology, Advanced services & Softwares',
                'geo_focus' => 'Europe',
            ],

            [
                'company_id' => 1,
                'user_id' => 1,
                'fund' => 'DBAG',
                'type' => 'Private equity, VC',
                'region' => 'DACH',
                'based' => 'de',
                'main_countries' => 'Germany',
                'main_cities' => 'Frankfurt',
                'sector' => 'Industrial Services, mechanical and engineering, industrial components, industrial components.',
                'geo_focus' => 'Europe Mostly Germany',
            ],

            [
                'company_id' => 1,
                'user_id' => 1,
                'fund' => 'CASTIK Capital Partners',
                'type' => 'Private equity, VC',
                'region' => 'DACH',
                'based' => 'de',
                'main_countries' => 'Germany',
                'main_cities' => 'Munich',
                'sector' => 'Precision Manufacturing, IOT solutions, Healthcare, Software, business services',
                'geo_focus' => 'Europe',
            ],

            [
                'company_id' => 1,
                'user_id' => 1,
                'fund' => 'Investindustrial',
                'type' => 'Private equity, VC',
                'region' => 'South Europeans Funds',
                'based' => 'es',
                'main_countries' => 'Spain, Switzerland',
                'main_cities' => 'Madrid, Lugano',
                'sector' => 'Healtchare consumer and leisure, industrial Manufacturing, Technology',
                'geo_focus' => 'Europe',
            ],

            [
                'company_id' => 1,
                'user_id' => 1,
                'fund' => 'F2i',
                'type' => 'Private equity, VC',
                'region' => 'South Europeans Funds',
                'based' => 'it',
                'main_countries' => 'Italy',
                'main_cities' => 'Milan',
                'sector' => 'All',
                'geo_focus' => 'Europe Mostly Italy',
            ],

            [
                'company_id' => 1,
                'user_id' => 1,
                'fund' => 'FSI',
                'type' => 'Private equity, VC',
                'region' => 'South Europeans Funds',
                'based' => 'it',
                'main_countries' => 'italy',
                'main_cities' => 'Milan',
                'sector' => 'Fintech, engineering, fashion, biopharmaceutical',
                'geo_focus' => 'Europe',
            ],

            [
                'company_id' => 1,
                'user_id' => 1,
                'fund' => 'NB renaissance partners',
                'type' => 'Private equity, VC',
                'region' => 'South Europeans Funds',
                'based' => 'it',
                'main_countries' => 'Italy, Uk, Zurich',
                'main_cities' => 'Milan, london, Zurich',
                'sector' => 'All',
                'geo_focus' => 'Global',
            ],

            [
                'company_id' => 1,
                'user_id' => 1,
                'fund' => 'Alpha Group',
                'type' => 'Private equity, VC',
                'region' => 'South Europeans Funds',
                'based' => 'it',
                'main_countries' => 'Italy, Germany, France',
                'main_cities' => 'Milan, Frankfurt, Paris',
                'sector' => 'industrial, consumer and leisure, fashion & design',
                'geo_focus' => 'Europe',
            ],

            // 30
            [
                'company_id' => 1,
                'user_id' => 1,
                'fund' => 'MBK Partners',
                'type' => 'Private Equity',
                'region' => 'Asia',
                'based' => 'kr',
                'main_countries' => 'South Korea',
                'main_cities' => 'Seoul',
                'sector' => 'All',
                'geo_focus' => 'North Asia',
            ],

            [
                'company_id' => 1,
                'user_id' => 1,
                'fund' => 'Affinity equity Partners',
                'type' => 'Private Equity',
                'region' => 'Asia',
                'based' => 'hk',
                'main_countries' => 'Hong kong, Singapore, Korea, Australia',
                'main_cities' => 'Hong kong, Singapore, Seoul, Sidney',
                'sector' => 'consumer-related goods and services, food and beverage, healthcare and pharmaceutical, financial services, telecom and media, environmental businesses, agriculture and natural resources. We do not invest in companies whose principal business activities are real estate, biotechnology, tobacco, oil and gas exploration, and weaponry development and sales.',
                'geo_focus' => 'APAC',
            ],

            [
                'company_id' => 1,
                'user_id' => 1,
                'fund' => 'RRj Capital',
                'type' => 'Private Equity',
                'region' => 'Asia',
                'based' => 'hk',
                'main_countries' => 'Hong kong, Singapore',
                'main_cities' => 'Hong kong, Singapore',
                'sector' => 'healthcare, financial institutions, technology, and logistics.',
                'geo_focus' => 'APAC, Europe, USA',
            ],

            [
                'company_id' => 1,
                'user_id' => 1,
                'fund' => 'Baring Private equity Asia',
                'type' => 'Private Equity',
                'region' => 'Asia',
                'based' => 'hk',
                'main_countries' => 'Hong kong, China, India',
                'main_cities' => 'Hong Kong, Beijing, Mumbai',
                'sector' => 'All',
                'geo_focus' => 'APAC',
            ],

            [
                'company_id' => 1,
                'user_id' => 1,
                'fund' => 'CITIC PE',
                'type' => 'Private Equity',
                'region' => 'Asia',
                'based' => 'cn',
                'main_countries' => 'China, Hong kong',
                'main_cities' => 'Beijing,  Hong Kong',
                'sector' => 'healthcare, Consumer and internet, Technology and industrial , Software',
                'geo_focus' => 'APAC',
            ],

            [
                'company_id' => 1,
                'user_id' => 1,
                'fund' => 'CDH Investments',
                'type' => 'Private Equity , VC',
                'region' => 'Asia',
                'based' => 'cn',
                'main_countries' => 'China, Hong kong',
                'main_cities' => 'Beijing,  Hong Kong',
                'sector' => 'Retail, consumer goods, industrial Energy, Financial services, TMT, Automotiles, Logistic',
                'geo_focus' => 'Asia Mostly china',
            ],

            [
                'company_id' => 1,
                'user_id' => 1,
                'fund' => 'CITIC Capital',
                'type' => 'Private Equity',
                'region' => 'Asia',
                'based' => 'cn',
                'main_countries' => 'China , Japan',
                'main_cities' => 'Tokyo , Beijing',
                'sector' => 'All',
                'geo_focus' => 'APAC',
            ],

            [
                'company_id' => 1,
                'user_id' => 1,
                'fund' => 'PAG',
                'type' => 'Private Equity',
                'region' => 'Asia',
                'based' => 'jp',
                'main_countries' => 'Japan, Singapore, South korea, Australia, Switzerland',
                'main_cities' => 'Tokyo, Singapore, Seoul, Sidney, Geneva',
                'sector' => 'Business and product services, Consumers, tech, financials services, media & enterteiment',
                'geo_focus' => 'Americas, Asia-Pacific, Europe',
            ],

            [
                'company_id' => 1,
                'user_id' => 1,
                'fund' => 'Hopu Investments Management',
                'type' => 'Private Equity, VC',
                'region' => 'Asia',
                'based' => 'cn',
                'main_countries' => 'China',
                'main_cities' => 'Beijing ',
                'sector' => 'NI',
                'geo_focus' => 'Asia ',
            ],

            [
                'company_id' => 1,
                'user_id' => 1,
                'fund' => 'Hony Capital',
                'type' => 'Private Equity',
                'region' => 'Asia',
                'based' => 'cn',
                'main_countries' => 'China, Hong kong',
                'main_cities' => 'Beijing,  Hong Kong',
                'sector' => 'pharmaceutical and healthcare, consumer products, catering, media and entertainment, environmental protection and new energy',
                'geo_focus' => 'Global',
            ],
            //40
            [
                'company_id' => 1,
                'user_id' => 1,
                'fund' => 'Ince Capital Partners',
                'type' => 'Private Equity',
                'region' => 'Asia',
                'based' => 'cn',
                'main_countries' => 'China, Hong kong',
                'main_cities' => 'Beijing,  Hong Kong',
                'sector' => 'Internet consumer and intelligent technologies',
                'geo_focus' => 'China',
            ],

            [
                'company_id' => 1,
                'user_id' => 1,
                'fund' => 'Mercury Capital',
                'type' => 'Private Equity, Direct placement',
                'region' => 'Asia',
                'based' => 'jp',
                'main_countries' => 'Japan, Singapore, India',
                'main_cities' => 'Tokyo, Singapore, New Dehli',
                'sector' => 'NI',
                'geo_focus' => 'Global',
            ],

            [
                'company_id' => 1,
                'user_id' => 1,
                'fund' => 'Olympus Capital',
                'type' => 'Private Equity, VC',
                'region' => 'Asia',
                'based' => 'cn',
                'main_countries' => 'China, India',
                'main_cities' => 'Shangai, Delhi',
                'sector' => 'including financial services, environmental services, business services, healthcare and renewable energy,',
                'geo_focus' => 'Asia',
            ],

            [
                'company_id' => 1,
                'user_id' => 1,
                'fund' => 'Tiger Global Management',
                'type' => 'Private Equity, VC',
                'region' => 'Asia',
                'based' => 'cn',
                'main_countries' => 'China/ Usa',
                'main_cities' => 'New york',
                'sector' => 'Internet, technology, telecom, media consumer, and industrial',
                'geo_focus' => 'Global',
            ]
        ];

        DB::table('peccs')->insert($peccs);

        $update = [
            'logo' => '/storage/factory/avatar/misc/avatar-company.jpg',
            'created_at' => now(),
            'updated_at' => now()
        ];

        DB::table('peccs')->update($update);

    }
}
