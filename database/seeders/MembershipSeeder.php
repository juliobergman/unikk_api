<?php

namespace Database\Seeders;

use App\Models\Membership;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Factories\Sequence;

class MembershipSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Membership::factory(2)
        ->state(new Sequence(
            [
            // 'id' => 1,
            'user_id' => 1,
            'company_id' => 1,
            'job_title' => 'Developer',
            'role' => 'admin',
            // 'default' => 1,
            'created_at' => now(),
            'updated_at' => now(),
            ],
            [
            // 'id' => 1,
            'user_id' => 1,
            'company_id' => 2,
            'job_title' => 'Designer',
            'role' => 'admin',
            // 'default' => 1,
            'created_at' => now(),
            'updated_at' => now(),
            ],
        ))
        ->create();
    }
}
