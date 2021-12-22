<?php

namespace Database\Factories;

use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class PeccFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'logo' => '/storage/factory/avatar/misc/avatar-company.jpg',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ];
    }
}
