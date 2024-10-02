<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;


class ServiceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected static int $counter = 0;

    public function definition(): array
    {
        return [

            'name_ar' => $this->faker->word,
            'name_en' => $this->faker->word
        ];
    }
}
