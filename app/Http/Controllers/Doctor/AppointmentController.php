<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Patient;
use App\Notifications\PatientAppointNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use function redirect;
use function view;

class AppointmentController extends Controller
{
    public function index()
    {
        $this->data['patients'] = Appointment::with('patient')->where('doctor_id', Auth::guard('doctor')->id())->latest()->get();
        return view('doctor.appointments', $this->data);
    }

    public function approveAppointment($id, $patient_id)
    {
        //   return $patient_id;
        if (Appointment::find($id)->update(['status' => 1])) {
            $patient = Patient::find($patient_id);
            $key = 'approve';
            $details = [
                'greeting' => 'Hi, ' . $patient->name,
                'body' => 'Your Appoint has Approved',
                'thanks' => 'Thank you from (' . Auth::guard('doctor')->user()->name . ')',
            ];
            $patient->notify(new PatientAppointNotification($key, $details));
            $this->setSuccessMessage('Appoint Approved Successfully!');
            return redirect()->back();
        }
    }

    public function seenAppointment($id, $patient_id)
    {
        // return $id. $patient_id;
        if (Appointment::find($id)->update(['status' => 2])) {
            $patient = Patient::find($patient_id);
            $key = 'seen';
            $details = [
                'greeting' => 'Hi, ' . $patient->name,
                'body' => 'Seen Notification.',
                'thanks' => 'Thank you from (' . Auth::guard('doctor')->user()->name . ')',
            ];
            $patient->notify(new PatientAppointNotification($key, $details));
            $this->setSuccessMessage('Appoint Seen Successfully!');
            return redirect()->back();
        }
    }

    public function cancelAppointment($id, $patient_id)
    {
        // return $id. $patient_id;
        if (Appointment::find($id)->update(['status' => 3])) {
            $this->setSuccessMessage('Appoint Cancel Successfully!');
            return redirect()->back();
        }
    }
}
