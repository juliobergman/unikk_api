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
            'currency_id' => 2,
            'address' => $this->faker->address(),
            'city' => $this->faker->city(),
            'sector' => $this->faker->bs(),
            'country' => $this->faker->countryCode(),
            'phone' => $this->faker->phoneNumber(),
            'email' => $this->faker->companyEmail(),
            'website' => $this->faker->domainName(),
            'info' => $this->faker->paragraph(10),
            'logo' => '/storage/factory/avatar/misc/avatar-company.jpg',
            'shares' => 100,
            'taxrate' => 12.5,
        ];
    }
}
