<?php

namespace App\Http\Controllers\Doctor\Auth;

use function abort;
use App\Events\DoctorCreatedEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\DoctorRegister;
use App\Models\Doctor;
use App\Notifications\DoctorVerificationNotification;
use function auth;
use function event;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Str;
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
        $create = new Doctor();
        $create->name = $request->input('name');
        $create->slug = $request->input('name');
        $create->email = $request->input('email');
        $create->password = $request->input('password');
        $create->verified_token = md5($request->input('email')) . uniqid('Shahin',true);

        if($create->save()){
            //send verification link using Event Listener
              event(new DoctorCreatedEvent($create));
            //send verification link using Notification
           $create->notify(new DoctorVerificationNotification($create));
            return redirect()
                ->action([LoginController::class,'showLoginForm'])
                ->with('message','Your Account has been Created!. Please verify');
        }
    }

    public function verifyDoctorAccount($token)
    {
        $doctor = Doctor::where('verified_token', $token)->first();
        if (!$doctor) {
            //invalid token
            return redirect()
                ->action([LoginController::class, 'showLoginForm'])
                ->with('message', 'Invalid Token :)');
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
