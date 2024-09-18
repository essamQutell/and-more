<?php

namespace Database\Factories;

use App\Models\SupplierTeam;
use Illuminate\Database\Eloquent\Factories\Factory;


class SupplierTeamFactory extends Factory
{

    public function definition():array
    {
        return [
            'name' => $this->faker->company,
            'email' => $this->faker->email,
            'phone' => $this->faker->numerify('##########'),
            'supplier_id' => $this->faker->numberBetween(1, 10),
        ];
    }
}
