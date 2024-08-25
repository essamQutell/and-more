<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //  DB::table('admins')->truncate();
        $admin = Admin::create([
            'name' => 'super_admin',
            'email' => 'super@admin.com',
            'password' => bcrypt('12345678'),
        ]);
        $admin->addRole('super_admin');

        // Second Admin
        $admin2 = Admin::create([
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('12345678'),
        ]);
        $admin2->addRole('super_admin');
    }
}
