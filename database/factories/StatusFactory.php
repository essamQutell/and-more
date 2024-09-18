<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;


class StatusFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name_ar' => $this->faker->word,
            'name_en' => $this->faker->word,
            'type_id' => $this->faker->randomElement([1, 2])
        ];
    }
}
