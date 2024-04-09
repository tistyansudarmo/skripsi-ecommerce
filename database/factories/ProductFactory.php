<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //
            'category_id' => $this->faker->randomElement([1, 2, 3]),
            'title' => $this->faker->word(),
            'description' => $this->faker->text(120),
            'price' => $this->faker->numberBetween(10000, 100000),
            'image' => ''
        ];
    }
}
