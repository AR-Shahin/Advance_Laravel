<?php

namespace App\Http\Controllers\Patient\Auth;

use function abort;
use App\Http\Controllers\Controller;
use App\Http\Requests\PatientLoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use function isCredentialVerified;
use function isDoctorActive;
use function redirect;

class LoginController extends Controller
{
    public function showLoginForm(){
        if(View::exists('patient.auth.login')){
            return view('patient.auth.login');
        }
        abort(404);
    }

    public function loginProcess(PatientLoginRequest $request){
        $credentials = $request->validated();
        if(Auth::guard('patient')->attempt($credentials)){
            //check verify
            if(isCredentialVerified($request->input('email'),'PATIENT')){
                return redirect(RouteServiceProvider::PATIENT);
            }else{
                Auth::guard('patient')->logout();
                return redirect()->back()->with('message','Your Not verified');
            }
        }else{
            return redirect()->back()->with('message','Not Match!');
        }
    }

    public function logout(){
        Auth::guard('doctor')->logout();
        return redirect()->action([LoginController::class,'showLoginForm'])->with('message','Log out!');
    }
}

