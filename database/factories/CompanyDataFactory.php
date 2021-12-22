<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CompanyDataFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'address' => $this->faker->address(),
            'city' => $this->faker->city(),
            'sector' => $this->faker->bs(),
            'country' => strtolower($this->faker->countryCode()),
            'phone' => $this->faker->phoneNumber(),
            'email' => $this->faker->companyEmail(),
            'website' => $this->faker->domainName(),
            'info' => $this->faker->paragraph(10),
            'logo' => '/storage/factory/avatar/misc/avatar-company.jpg',
        ];
    }
}
