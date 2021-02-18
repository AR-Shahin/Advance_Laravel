<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use function date;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use function redirect;

class AppointmentController extends Controller
{
    public function storeAppointment($id){
        $doctor = Doctor::find($id);

        $doctor->appointments()->create([
            'patient_id' => Auth::guard('patient')->id(),
            'appointment_time' => date('Y-m-d')
        ]);
        return redirect()->route('patient.dashboard');
    }
}
