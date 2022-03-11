<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Contact;
use App\Models\Membership;
use App\Models\UserData;
use Database\Factories\MembershipFactory;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Factories\Sequence;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory(1)
        ->state([
            'id' => 1,
            'name' => env('OWNER_NAME'),
            'email' => env('OWNER_EMAIL'),
            'email_verified_at' => now(),
            'password' => Hash::make(env('OWNER_PASSWORD')),
            'remember_token' => Str::random(10),
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ])
        ->has(UserData::factory()->state([
            'profile_pic' => '/storage/factory/avatar/misc/stormtrooper.jpg',
            'country' => 'VE',
        ]))
        ->has(Contact::factory(10))
        ->has(Membership::factory(1)->state(new Sequence(
            [
                'company_id' => 1,
                'job_title' => 'Developer',
                'role' => 'admin',
            ],
            [
                'company_id' => 2,
                'job_title' => 'Designer',
                'role' => 'admin',
            ]
        ))
        )
        ->create();

        User::factory(0)
        ->state(new Sequence(
            ['email_verified_at' => now()],
            ['email_verified_at' => null],
        ))
        ->has(
            UserData::factory()
            ->state(new Sequence(
                ['gender' => 'male'],
                ['gender' => 'female'],
            ))
            ->state(new Sequence(
                ['profile_pic' => '/storage/factory/avatar/male/avatar-1.jpg'],
                ['profile_pic' => '/storage/factory/avatar/female/avatar-1.jpg'],
                ['profile_pic' => '/storage/factory/avatar/male/avatar-2.jpg'],
                ['profile_pic' => '/storage/factory/avatar/female/avatar-2.jpg'],
                ['profile_pic' => '/storage/factory/avatar/male/avatar-3.jpg'],
                ['profile_pic' => '/storage/factory/avatar/female/avatar-3.jpg'],
                ['profile_pic' => '/storage/factory/avatar/male/avatar-4.jpg'],
                ['profile_pic' => '/storage/factory/avatar/female/avatar-4.jpg'],
                ['profile_pic' => '/storage/factory/avatar/male/avatar-5.jpg'],
                ['profile_pic' => '/storage/factory/avatar/female/avatar-5.jpg'],
                ['profile_pic' => '/storage/factory/avatar/male/avatar-6.jpg'],
                ['profile_pic' => '/storage/factory/avatar/female/avatar-6.jpg'],
                ['profile_pic' => '/storage/factory/avatar/male/avatar-7.jpg'],
                ['profile_pic' => '/storage/factory/avatar/female/avatar-7.jpg'],
                ['profile_pic' => '/storage/factory/avatar/male/avatar-8.jpg'],
                ['profile_pic' => '/storage/factory/avatar/female/avatar-8.jpg'],
                ['profile_pic' => '/storage/factory/avatar/male/avatar-9.jpg'],
                ['profile_pic' => '/storage/factory/avatar/female/avatar-9.jpg'],
                ['profile_pic' => '/storage/factory/avatar/male/avatar-10.jpg'],
                ['profile_pic' => '/storage/factory/avatar/female/avatar-10.jpg'],
            ))
  
        )
        ->has(
            Membership::factory(1)
            ->state(new Sequence(
                ['company_id' => 1],
                ['company_id' => 2],
            ))
            ->state(new Sequence(
                ['role' => 'user'],
                ['role' => 'editor'],
                ['role' => 'admin'],
            ))
        )
        ->create();
    }
}
