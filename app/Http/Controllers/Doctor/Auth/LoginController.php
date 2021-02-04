<?php

namespace App\Http\Controllers\Doctor\Auth;

use function abort;
use App\Http\Controllers\Controller;
use App\Http\Requests\DoctorLogin;
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
        if(View::exists('doctor.auth.login')){
            return view('doctor.auth.login');
        }
        abort(404);
    }

    public function loginProcess(DoctorLogin $request){
        $credentials = $request->validated();
        if(Auth::guard('doctor')->attempt($credentials)){
            //check verify
            if(isCredentialVerified($request->input('email'),'DOCTOR')){
                //check status
                if(isDoctorActive($request->input('email'))){
                    return redirect(RouteServiceProvider::DOCTOR);
                }else{
                    Auth::guard('doctor')->logout();
                    return redirect()->back()->with('message','Your Status is Inactive.');
                }
            }else{
                Auth::guard('doctor')->logout();
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
