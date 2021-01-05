<?php

namespace App\Http\Controllers\Doctor\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\DoctorRegister;
use App\Models\Doctor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use function redirect;

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
        ]);
        if($create){
            return redirect()
                    ->action([LoginController::class,'showLoginForm'])
                    ->with('message','Your Account has been Created!');
        }
    }
}
