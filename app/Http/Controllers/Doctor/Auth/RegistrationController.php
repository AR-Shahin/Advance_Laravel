<?php

namespace App\Http\Controllers\Doctor\Auth;

use App\Events\DoctorCreatedEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\DoctorRegister;
use App\Models\Doctor;
use function event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use function md5;
use function redirect;
use const true;
use function uniqid;

class RegistrationController extends Controller
{
    public function showRegistrationForm(){
        if(View::exists('doctor.auth.register')){
            return view('doctor.auth.register');
        }
        abort(404);
    }

    public function registrationProcess(DoctorRegister $request){
        $create = Doctor::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => $request->input('password'),
            'verified_token' => md5($request->input('email')) . uniqid('Shahin',true)
        ]);
        if($create){
            event(new DoctorCreatedEvent($create));
            return redirect()
                    ->action([LoginController::class,'showLoginForm'])
                    ->with('message','Your Account has been Created!. Please verify');
        }
    }

    public function verifyDoctorAccount($token){
        return $token;
    }
}
