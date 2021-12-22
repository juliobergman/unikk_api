<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TokenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('personal_access_tokens')->insert([
            'id' => 1,
            'tokenable_type' => 'App\Models\User',
            'tokenable_id' => 1,
            'name' => 'MainToken',
            'token' => 'fa842a78e1c227cf10a86a0364214a4e8e6acc6e3ab0a003c1cdf6197d562ad1',
            'abilities' => '["server:view","server:update"]',
            'last_used_at' => now(),
        ]);
    }
}
