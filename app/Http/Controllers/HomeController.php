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
        //return $request->designations;
//        $doctor = $doctor->when($request->country, function($doctor) use($request){
//            return $doctor->where('country_id',$request->country);
//        })
//            ->when($request->designation, function($doctor) use($request){
//                return $doctor->where('designation_id',$request->designation);
//            });


        $doctor = $this->doctor->getAllDoctor();
        $doctor = $doctor->when($request->country,function ($doctor) use($request){
            return $doctor->where('country_id',$request->country);
        })->when($request->designations, function ($doctor) use($request){
            return $doctor->where('designation_id',$request->designations);
        })->when($request->visit, function ($doctor) use ($request) {
            return $doctor->where('visit_fee', $request->visit);
        });

        if(View::exists('frontend.home')){
            return view('frontend.home',[
                'doctors' =>   $doctor,
                'country_id' => $request->country ?? 0,
                'designations_id' => $request->designations ?? 0,
                'visit' => $request->visit ?? 00

            ]);
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
