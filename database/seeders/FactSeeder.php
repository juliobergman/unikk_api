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

        $categories = Category::where('company_id', 1)->whereNotNull('account')->get();

        foreach ($categories as $key => $value) {
            $facts[] = [
                'section' => 'actual',
                'date' => '2022-01-01',
                'category_id' => $value->id,
                'company_id' => '1',
                'amount' => rand(-500,500),
            ];
            $facts[] = [
                'section' => 'forecast',
                'date' => '2022-01-01',
                'category_id' => $value->id,
                'company_id' => '1',
                'amount' => rand(-500,500),
            ];
            $facts[] = [
                'section' => 'actual',
                'date' => '2021-01-01',
                'category_id' => $value->id,
                'company_id' => '1',
                'amount' => rand(-500,500),
            ];
        }

        DB::table('facts')->insert($facts);
    }
}
