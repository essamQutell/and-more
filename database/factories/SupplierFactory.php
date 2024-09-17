<?php

namespace Database\Factories;

use App\Models\Supplier;
use Illuminate\Database\Eloquent\Factories\Factory;


class SupplierFactory extends Factory
{
    protected $model = Supplier::class;

    public function definition()
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
