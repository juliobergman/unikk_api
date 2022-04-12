<?php

namespace Database\Seeders;

use App\Models\Fact;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;

class FactSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Fact::factory(500)
        // ->state(new Sequence([
        //     'category_id' => 1,
        //     'category_id' => 2,
        //     'category_id' => 3,
        //     'category_id' => 4,
        //     'category_id' => 5,
        //     'category_id' => 6,
        //     'category_id' => 7,
        //     'category_id' => 8,
        //     'category_id' => 9,
        //     'category_id' => 10,
        //     'category_id' => 11,
        //     'category_id' => 12,
        //     'category_id' => 13,
        //     'category_id' => 14,
        //     'category_id' => 15,
        //     'category_id' => 16,
        //     'category_id' => 17,
        //     'category_id' => 18,
        //     'category_id' => 19,
        //     'category_id' => 20,
        // ]))
        // ->state(new Sequence(
        //     ['section' => 'actual'],
        //     ['section' => 'forecast'],
        // ))
        ->create();
    }
}
