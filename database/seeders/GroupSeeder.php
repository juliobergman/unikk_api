<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $groups = [
            ['id' => 1, 'type' => 'income', "sort" => 1, 'name' => 'Gross Profit'],
            ['id' => 2, 'type' => 'income', "sort" => 2, 'name' => 'Operative Income'],
            ['id' => 3, 'type' => 'income', "sort" => 3, 'name' => 'Earning Before Taxes'],
            ['id' => 4, 'type' => 'income', "sort" => 4, 'name' => 'Net Income'],
            ['id' => 5, 'type' => 'balance', "sort" => 1, 'name' => 'Total Assets'],
            ['id' => 6, 'type' => 'balance', "sort" => 2, 'name' => 'Total Liabilities'],
            ['id' => 7, 'type' => 'balance', "sort" => 3, 'name' => 'Total Equity'],
        ];

        DB::table('groups')->insert($groups);

        $update = [
            'created_at' => now(),
            'updated_at' => now()
        ];

        DB::table('groups')->update($update);
    }
}
