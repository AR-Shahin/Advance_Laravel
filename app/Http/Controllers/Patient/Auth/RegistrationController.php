<?php

namespace App\Http\Controllers\Patient\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\PatientRegistrationRequest;
use App\Models\Doctor;
use App\Models\Patient;
use function auth;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\View;
use function redirect;
use const true;

class RegistrationController extends Controller
{
    public function showRegistrationForm(){
        if(View::exists('patient.auth.register')){
            return view('patient.auth.register');
        }
        abort(404);
    }

    public function registrationProcess(PatientRegistrationRequest $request){
        $patient = new Patient();
        $patient->name = $request->input('name');
        $patient->slug = $request->input('name');
        $patient->email = $request->input('email');
        $patient->password = $request->input('password');
        $patient->token = $request->input('email');
        if($patient->save()){
            return redirect()
                ->action([LoginController::class,'showLoginForm'])
                ->with('message','Your Account has been Created!. Please verify');
        }else{
            return redirect()
                ->action([LoginController::class,'showLoginForm'])
                ->with('message','Something is Wrong.');
        }
    }

    public function verifyDoctorAccount($token){
        $doctor = Doctor::where('verified_token',$token)->first();
        if(!$doctor){
            //invalid token
            return redirect()
                ->action([LoginController::class,'showLoginForm'])
                ->with('message','Invalid Token :)');
        }
        //update
        $doctor->update([
            'verified_token' => null,
            'verified' => true
        ]);

        auth()->guard('doctor')->login($doctor);
        return redirect(RouteServiceProvider::DOCTOR);

    }
}
