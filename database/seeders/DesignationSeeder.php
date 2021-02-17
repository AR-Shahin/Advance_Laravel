<?php

namespace Database\Seeders;

use function count;
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
        $designatins = ['Heart','Eye','Head','Hand','Child','Nose','Kidney','Liver'];
        for($i=0;$i<count($designatins);$i++) {
            DB::table('designations')->insert([
                'name' => $designatins[$i] . ' Specialist',
                'slug' => $designatins[$i] . '-Specialist',
                'description' => Str::random(15),
            ]);
        }
    }
}
