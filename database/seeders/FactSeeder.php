<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\DateDimension;
use App\Models\Fact;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Support\Facades\Date;

class FactSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $facts = [];
        $months = [
            '01',
            '02',
            '03',
            '04',
            '05',
            '06',
            '07',
            '08',
            '09',
            '10',
            '11',
            '12',
        ];

        $categories = Category::where('company_id', 1)->whereNotNull('account')->get();

        foreach ($categories as $key => $value) {
            foreach ($months as $mk => $mv) {
            
                $facts[] = [
                    'section' => 'actual',
                    'date' => '2022-'.$mv.'-01',
                    'category_id' => $value->id,
                    'company_id' => '1',
                    'amount' => rand(250, 1250),
                ];
                $facts[] = [
                    'section' => 'forecast',
                    'date' => '2022-'.$mv.'-01',
                    'category_id' => $value->id,
                    'company_id' => '1',
                    'amount' => rand(250, 1250),
                ];
                $facts[] = [
                    'section' => 'actual',
                    'date' => '2021-'.$mv.'-01',
                    'category_id' => $value->id,
                    'company_id' => '1',
                    'amount' => rand(250, 1250),
                ];

            }

        }

        DB::table('facts')->insert($facts);
    }
}
