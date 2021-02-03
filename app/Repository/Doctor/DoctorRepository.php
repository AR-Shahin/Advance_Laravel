<?php

namespace App\Repository\Doctor;

use App\Models\Doctor;
class DoctorRepository implements DoctorInterface{

    public function getAllDoctor()
    {
        return Doctor::with(['designation','country'])->latest()->get();
    }
}