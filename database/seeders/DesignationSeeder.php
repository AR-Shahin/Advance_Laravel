<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class DesignationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i=1;$i<5;$i++) {
            DB::table('designations')->insert([
                'name' => Str::random(5),
                'slug' => Str::random(5),
                'description' => Str::random(15),
            ]);
        }
    }
}
