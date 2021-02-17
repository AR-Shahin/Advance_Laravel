<?php

namespace Database\Seeders;

use App\Models\Doctor;
use function count;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use function rand;
use function random_int;
use function uniqid;

class DoctorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $names = ['Shahin','Omi','Himel','Tamanna','Asik','Tanzim','Bappy','Samira'];
        for($i=0;$i<count($names);$i++){
            $doctor = new Doctor();
            $doctor->name = $names[$i];
            $doctor->slug = $names[$i]. '-'.uniqid();
            $doctor->email = $names[$i].'@gmail.com';
            $doctor->password = 123;
            $doctor->designation_id = rand(1,7);
            $doctor->country_id = rand(1,5);
            $doctor->avatar = 'uploads/avatars/default.jpg';
            $doctor->save();
        }
    }
}
