<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class RunAllSeeders extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            CountrySeeder::class, DesignationSeeder::class,DoctorSeeder::class,RolePermissionSeeder::class
        ]);
    }
}
