<?php

namespace Database\Seeders;

use App\Models\SupplierTeam;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SupplierTeamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        SupplierTeam::factory()->count(10)->create();

    }
}
