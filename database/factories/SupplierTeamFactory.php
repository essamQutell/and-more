<?php

namespace Database\Factories;

use App\Models\SupplierTeam;
use Illuminate\Database\Eloquent\Factories\Factory;


class SupplierTeamFactory extends Factory
{
    protected $model = SupplierTeam::class;

    public function definition()
    {
        return [
            'name' => $this->faker->company,
            'email' => $this->faker->email,
            'phone' => $this->faker->numerify('##########'),
            'supplier_id' => $this->faker->numberBetween(1, 10),
        ];
    }
}
