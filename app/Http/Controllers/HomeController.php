<?php

namespace App\Http\Controllers;

use function abort;
use App\Models\Country;
use App\Models\Designations;
use App\Models\Doctor;
use App\Repository\Doctor\DoctorInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class HomeController extends Controller
{
    public $doctor;
    public function __construct(DoctorInterface $doctor)
    {
        $this->doctor = $doctor;
    }

    public function index(Request $request){

         $request->input('country_id');
        $this->data['doctors'] = $this->doctor->getAllDoctor();
        $this->data['countries'] = Country::select('id','name')->latest()->get();
        $this->data['designations'] = Designations::select('id','name')->latest()->get();
        if(View::exists('frontend.home')){
            return view('frontend.home',$this->data);
        }
        abort(404);
    }

    public function getDoctorDetails(Doctor $slug){
       if(View::exists('frontend.single_doctor')){
           return \view('frontend.single_doctor',[
               'doctor' => $this->doctor->getDoctorDetails($slug)
           ]);
       }

    }
}
