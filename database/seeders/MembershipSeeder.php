<?php

namespace Database\Seeders;

use App\Models\Membership;
use Illuminate\Database\Seeder;

class MembershipSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Membership::factory(1)
        ->state([
            'id' => 1,
            'user_id' => 1,
            'company_id' => 1,
            'job_title' => 'Developer',
            'role' => 'admin',
            'default' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ])
        ->create();
    }
}
