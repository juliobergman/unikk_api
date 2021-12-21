<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class UserDataFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'profile_pic' => '/storage/factory/avatar/misc/avatar-user.jpg',
            'phone' => $this->faker->phoneNumber(),
            'country' => $this->faker->countryCode(),
            'city' => $this->faker->city(),
            'address' => $this->faker->streetAddress(),
            'gender' => 'male',
            'site' => $this->faker->domainName(),
        ];
    }
}
