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
        Fact::factory(800)
        ->state(new Sequence(
            ['type' => 'actual'],
            ['type' => 'forecast'],
        ))
        ->create();
    }
}
