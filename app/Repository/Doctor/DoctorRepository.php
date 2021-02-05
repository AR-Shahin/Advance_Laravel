<?php

namespace App\Repository\Doctor;

use App\Models\Doctor;
class DoctorRepository implements DoctorInterface{

    public function getAllDoctor()
    {
        return Doctor::IsActive()->latest()->get();
    }
    public function getDoctorDetails(Doctor $slug)
    {
        return $slug;
    }
}