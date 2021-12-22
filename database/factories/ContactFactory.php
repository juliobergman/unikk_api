<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ContactFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => 1,
            'name' => $this->faker->name(),
            'company' => $this->faker->company(),
            'email' => $this->faker->email(),
            'phone' => $this->faker->e164PhoneNumber(),
            'address' => $this->faker->address(),
            'profile_pic' => '/storage/factory/avatar/misc/avatar-user.jpg',
        ];
    }
}
