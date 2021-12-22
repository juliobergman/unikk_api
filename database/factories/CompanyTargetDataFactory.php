<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CompanyTargetDataFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'company_ov' => $this->faker->paragraph(10),
            'financial_ov' => $this->faker->paragraph(10),
            'milestones' => $this->faker->paragraph(10),
            'competitors' => $this->faker->paragraph(10),
            'goals' => $this->faker->paragraph(10),
            'channels' => $this->faker->paragraph(10),
            'challenges' => $this->faker->paragraph(10),
        ];
    }
}
