<?php

use App\Models\Doctor;

if(!function_exists('isDoctorActive')){
    function isDoctorActive($email) :bool {
        $doctor = Doctor::whereEmail($email)->IsActive()->exists();
        if($doctor){
            return true;
        }else{
            return false;
        }
    }
}