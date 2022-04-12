<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\DateDimension;
use Illuminate\Database\Eloquent\Factories\Factory;
use Staudenmeir\LaravelAdjacencyList\Eloquent\HasRecursiveRelationships;

class FactFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'date' => DateDimension::all()->unique()->random()->date,
            'category_id' => Category::whereNotNull('account')->get()->unique()->random()->id,
            'company_id' => 1,
            'amount' => rand(250, 450),
        ];
    }
}
