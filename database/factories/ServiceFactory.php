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
            'parent_id' => function () {
                self::$counter++;
                return (self::$counter <= 5) ? null : $this->faker->numberBetween(1, 5);
            },
            'name_ar' => $this->faker->word,
            'name_en' => $this->faker->word
        ];
    }
}
