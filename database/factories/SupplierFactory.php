<?php

namespace Database\Factories;

use App\Models\Supplier;
use Illuminate\Database\Eloquent\Factories\Factory;


class SupplierFactory extends Factory
{

    public function definition():array
    {
        return [
            'name' => $this->faker->company,
            'email' => $this->faker->email,
            'phone' => $this->faker->numerify('##########'),
            'address' => $this->faker->address,
            'balance' => $this->faker->randomFloat(2, 0, 1000),
        ];
    }
}
