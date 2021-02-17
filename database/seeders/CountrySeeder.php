<?php

namespace Database\Seeders;

use function count;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use function strtoupper;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $countries = ['Bangladesh','India','Pakistan','Dubai','Japan','China','USA'];
        for($i=0;$i<count($countries);$i++) {
            DB::table('countries')->insert([
                'name' => $countries[$i]
            ]);
        }
    }
}
