<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;


class CategoryFactory extends Factory
{

    public function definition():array
    {
        return [
            'name_ar' => $this->faker->word,
            'name_en' => $this->faker->word
        ];
    }
}
