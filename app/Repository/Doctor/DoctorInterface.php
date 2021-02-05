<?php

namespace App\Repository\Doctor;

use App\Models\Doctor;

interface DoctorInterface{
    public function getAllDoctor();
    public function getDoctorDetails(Doctor $slug);
}