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
        
        

        Fact::factory(20)
        ->state(new Sequence(
            ['category_id' => 39],
            ['category_id' => 40],
            ['category_id' => 41],
            ['category_id' => 42],
            ['category_id' => 43],
            ['category_id' => 44],
            ['category_id' => 45],
            ['category_id' => 46],
            ['category_id' => 47],
            ['category_id' => 48],
        ))
        ->state(new Sequence(
            ['section' => 'actual'],
            ['section' => 'forecast'],
            ['section' => 'forecast'],
            ['section' => 'actual'],
        ))
        // ->state(new Sequence(
        //     ['company_id' => 1],
        //     ['company_id' => 2],
        // ))
        ->create();
    }
}
